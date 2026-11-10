<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f4f7fb">
    <title>Criar conta | Aula Alfa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <main class="auth-shell" id="main">
        <section class="auth-card" aria-labelledby="auth-title">
            <a class="auth-brand" href="{{ route('login') }}" aria-label="Aula Alfa, página de login">
                <span class="app-brand-mark"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
                <span>Aula Alfa</span>
            </a>

            <div class="auth-heading">
                <span class="eyebrow">JUNTE-SE A NÓS</span>
                <h1 id="auth-title">Crie sua conta</h1>
                <p>Preencha seus dados para começar.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger app-alert" role="alert">
                    <i class="bi bi-exclamation-circle me-2" aria-hidden="true"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input id="name" name="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Seu nome completo" value="{{ old('name') }}"
                           autocomplete="name" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input id="email" name="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="voce@exemplo.com" value="{{ old('email') }}"
                           autocomplete="email" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Senha</label>
                    <input id="password" name="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Mínimo de 8 caracteres" autocomplete="new-password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Use pelo menos 8 caracteres.</div>
                </div>

                <button type="submit" class="btn btn-primary w-100 auth-submit">
                    Criar conta <i class="bi bi-arrow-right ms-2" aria-hidden="true"></i>
                </button>
            </form>

            <p class="auth-footer">
                Já tem uma conta?
                <a href="{{ route('login') }}">Entrar</a>
            </p>
        </section>
        <p class="auth-caption">Uma experiência simples para você.</p>
    </main>
</body>
</html>
