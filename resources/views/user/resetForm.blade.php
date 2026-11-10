@extends('layouts.default')
@section('title', 'Solicitar nova senha')
@section('content')
    <div class="app-content">
        <div class="container-fluid app-content-container">
            <header class="page-heading">
                <div>
                    <span class="eyebrow">ADMINISTRAÇÃO</span>
                    <h1>Solicitar nova senha</h1>
                    <p>Confirme o e-mail associado à conta de {{ $user->name }}.</p>
                </div>
            </header>

            <section class="content-card form-card">
                <div class="content-card-heading">
                    <div>
                        <h2>Dados da conta</h2>
                        <p>A solicitação será registrada para o endereço informado.</p>
                    </div>
                    <span class="content-card-icon"><i class="bi bi-key" aria-hidden="true"></i></span>
                </div>

                <form action="{{ route('admin.users.reset', $user) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="resetEmail" class="form-label">E-mail</label>
                        <input id="resetEmail" name="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" autocomplete="email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-light">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-2" aria-hidden="true"></i>Enviar solicitação
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
