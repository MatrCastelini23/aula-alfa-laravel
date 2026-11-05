@extends('layouts.default')
@section('classe-body', 'register-page', 'register-page bg-body-secondary')
@section('content')
    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Lista de usuários</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            @forelse ($users as $user)
                <section class="card mb-3">
                    <div class="card-body">
                        <h2 class="h5">Nome: {{ $user->name }}</h2>
                        <p class="mb-0">Email: {{ $user->email }}</p>
                    </div>
                </section>
            @empty
                <p>Nenhum usuário cadastrado.</p>
            @endforelse

            {{ $users->links() }}
        </div>
    </div>
@endsection
