@extends('layouts.default')
@section('title', 'Editar usuário')
@section('content')
    <div class="app-content">
        <div class="container-fluid app-content-container">
            <header class="page-heading">
                <div>
                    <span class="eyebrow">ADMINISTRAÇÃO</span>
                    <h1>Editar usuário</h1>
                    <p>Atualize os dados da conta de {{ $user->name }}.</p>
                </div>
            </header>

            <section class="content-card form-card">
                <div class="content-card-heading">
                    <div>
                        <h2>Dados da conta</h2>
                        <p>Altere o nome ou o e-mail associado a este usuário.</p>
                    </div>
                    <span class="content-card-icon"><i class="bi bi-person-gear" aria-hidden="true"></i></span>
                </div>

                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input id="name" name="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" autocomplete="name" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">E-mail</label>
                        <input id="email" name="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" autocomplete="email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-light">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2 me-2" aria-hidden="true"></i>Salvar alterações
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
