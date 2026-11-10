<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);

        return view('user.index', [
            'users' => $users,
            'title' => 'Lista de usuario do Sistema',
        ]);
    }

    public function show(User $user)
    {
        return view('user.show', [
            'user' => $user,
        ]);
    }

    public function edit(User $user): View
    {
        return view('user.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user),
            ],
        ]);

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Usuário atualizado com sucesso.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->is($user)) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Você não pode excluir sua própria conta.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Usuário excluído com sucesso.');
    }

    public function resetForm(User $user)
    {
        return view('user.resetForm', [
            'user' => $user,
        ]);
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|string|email|exists:users,email',
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Solicitação de nova senha enviada para '.$request->email);
    }

    public function register()
    {
        return view('user.create');
    }

    public function create(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->profile()->create([
            'type' => 'user',
            'description' => 'Usuário comum',
        ]);

        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()
                ->route('admin.users.index')
                ->with('status', 'Usuário criado com sucesso.');
        }

        if (Auth::check()) {
            return redirect('/')->with('status', 'Usuário criado com sucesso.');
        }

        return redirect()
            ->route('login')
            ->with('status', 'Conta criada! Faça login para continuar.');
    }
}
