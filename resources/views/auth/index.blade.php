<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f4f7fb">
    <title>Entrar | Aula Alfa</title>
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
                <span class="eyebrow">BEM-VINDO(A) DE VOLTA</span>
                <h1 id="auth-title">Acesse sua conta</h1>
                <p>Entre com seus dados para continuar.</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success app-alert" role="status">
                    <i class="bi bi-check-circle me-2" aria-hidden="true"></i>{{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login.attempt') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input id="email" name="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="voce@exemplo.com" value="{{ old('email') }}"
                           autocomplete="email" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Senha</label>
                    <input id="password" name="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Sua senha" autocomplete="current-password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 auth-submit">
                    Entrar <i class="bi bi-arrow-right ms-2" aria-hidden="true"></i>
                </button>
            </form>

            <p class="auth-footer">
                Ainda não tem uma conta?
                <a href="{{ route('register') }}">Cadastre-se</a>
            </p>
        </section>
        <p class="auth-caption">Uma experiência simples para você.</p>
    </main>
</body>
</html>
