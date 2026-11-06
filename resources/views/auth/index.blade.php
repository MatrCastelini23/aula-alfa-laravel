@extends('layouts.default')
@section('hide-sidebar', true)
@section('classe-body', 'login-page bg-body-secondary')
@section('title', 'Login')
@section('content')
    <main class="login-box">
        <h1 class="login-logo">
            <a href="{{ url('/') }}"><b>Login</b></a>
        </h1>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Entre com seu email e senha</p>

                <form action="{{ route('login.attempt') }}" method="POST">
                    @csrf

                    @if (session('status'))
                        <div class="text-success mb-2">{{ session('status') }}</div>
                    @endif

                    <label class="visually-hidden" for="email">Email</label>
                    <div class="input-group mb-1">
                        <input id="email" name="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email" value="{{ old('email') }}" autofocus />
                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <div class="text-danger mb-2">{{ $message }}</div>
                    @enderror

                    <label class="visually-hidden" for="password">Senha</label>
                    <div class="input-group mb-1 mt-2">
                        <input id="password" name="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Senha" />
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>
                    @error('password')
                        <div class="text-danger mb-2">{{ $message }}</div>
                    @enderror

                    <div class="row mt-3 align-items-center">
                        <div class="col-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                                <label class="form-check-label" for="remember">Lembrar de mim</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </div>
                    </div>
                </form>

                <p class="mb-0 mt-3">
                    <a href="{{ route('register') }}" class="text-center">Criar uma conta</a>
                </p>
            </div>
        </div>
    </main>
@endsection
