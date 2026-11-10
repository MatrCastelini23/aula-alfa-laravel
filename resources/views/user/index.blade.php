@extends('layouts.default')
@section('title', 'Usuários')
@section('content')
    <div class="app-content">
        <div class="container-fluid app-content-container">
            @if (session('status'))
                <div class="alert alert-success app-alert" role="status">
                    <i class="bi bi-check-circle me-2" aria-hidden="true"></i>{{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger app-alert" role="alert">
                    <i class="bi bi-exclamation-circle me-2" aria-hidden="true"></i>{{ session('error') }}
                </div>
            @endif

            <header class="page-heading page-heading-with-action">
                <div>
                    <span class="eyebrow">ADMINISTRAÇÃO</span>
                    <h1>Usuários</h1>
                    <p>Consulte e gerencie as contas cadastradas no sistema.</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus me-2" aria-hidden="true"></i>Novo usuário
                </a>
            </header>

            <section class="content-card">
                <div class="content-card-heading">
                    <div>
                        <h2>Todos os usuários</h2>
                        <p>{{ $users->total() }} {{ $users->total() === 1 ? 'conta cadastrada' : 'contas cadastradas' }}</p>
                    </div>
                    <span class="content-card-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                </div>

                @if ($users->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table app-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col" class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="table-user">
                                                <span class="table-user-avatar" aria-hidden="true">
                                                    {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                                                </span>
                                                <span>{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="text-muted">{{ $user->email }}</td>
                                        <td class="text-end">
                                            <div class="user-actions">
                                                <a href="{{ route('admin.users.show', $user) }}"
                                                   class="btn btn-light btn-sm app-action-button">
                                                    <i class="bi bi-eye me-1" aria-hidden="true"></i>Detalhes
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-pencil me-1" aria-hidden="true"></i>Editar
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="bi bi-trash me-1" aria-hidden="true"></i>Excluir
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="app-pagination">
                        {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <div class="empty-state">
                        <span class="empty-state-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                        <h3>Nenhum usuário cadastrado</h3>
                        <p>Quando houver contas no sistema, elas aparecerão nesta lista.</p>
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection
