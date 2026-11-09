<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-rc4/dist/css/adminlte.min.css">
</head>
<body class="register-page bg-body-secondary">
    <main class="register-box">
        <div class="card">
            <div class="card-body register-card-body">
                <p class="register-box-msg">Preencha os campos para se cadastrar</p>

                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="name" type="text" class="form-control"
                               placeholder="Nome" value="{{ old('name') }}" autofocus>
                        <div class="input-group-text"><span class="bi bi-person"></span></div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control"
                               placeholder="Email" value="{{ old('email') }}">
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="Senha">
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>

                <p class="mb-0 mt-3 text-center">
                    Já tem conta? <a href="{{ route('login') }}">Entrar</a>
                </p>
            </div>
        </div>
    </main>
</body>
</html>
