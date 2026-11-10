@extends('layouts.default')

@section('title', 'Detalhes do usuário')

@section('content')
    <div class="app-content">
        <div class="container-fluid app-content-container">
            <header class="page-heading">
                <div>
                    <span class="eyebrow">ADMINISTRAÇÃO</span>
                    <h1>Detalhes do usuário</h1>
                    <p>Informações da conta selecionada.</p>
                </div>
            </header>

            <section class="content-card user-detail-card">
                <div class="user-detail-heading">
                    <span class="user-detail-avatar" aria-hidden="true">
                        {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                    </span>
                    <div>
                        <h2>{{ $user->name }}</h2>
                        <p>{{ $user->email }}</p>
                    </div>
                </div>

                <dl class="user-detail-list">
                    <div>
                        <dt>Nome completo</dt>
                        <dd>{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt>E-mail</dt>
                        <dd>{{ $user->email }}</dd>
                    </div>
                </dl>

                <div class="user-detail-actions">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left me-2" aria-hidden="true"></i>Voltar para usuários
                    </a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil me-2" aria-hidden="true"></i>Editar usuário
                    </a>
                    <a href="{{ route('admin.users.resetForm', $user) }}" class="btn btn-outline-primary">
                        <i class="bi bi-key me-2" aria-hidden="true"></i>Solicitar nova senha
                    </a>
                </div>
            </section>
        </div>
    </div>
@endsection