@extends('layouts.default')
@section('title', 'Início')
@section('content')
    <div class="app-content">
        <div class="container-fluid app-content-container">
            <header class="page-heading">
                <div>
                    <span class="eyebrow">VISÃO GERAL</span>
                    <h1>Início</h1>
                    <p>Acompanhe sua área de trabalho em um só lugar.</p>
                </div>
            </header>

            <section class="welcome-card">
                <div class="welcome-icon">
                    <i class="bi bi-sun" aria-hidden="true"></i>
                </div>
                <div>
                    <span class="eyebrow">BEM-VINDO(A)</span>
                    <h2>Olá, {{ auth()->user()->name }}!</h2>
                    <p>Que bom ter você por aqui. Use o menu ao lado para navegar pelo sistema.</p>
                </div>
            </section>
        </div>
    </div>
@endsection
