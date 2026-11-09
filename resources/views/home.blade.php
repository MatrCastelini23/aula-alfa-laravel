@extends('layouts.default')
@section('title', 'Início')
@section('content')
    <div class="app-content">
        <div class="container-fluid pt-3">
            <h1>Bem-vindo, {{ auth()->user()->name }}</h1>
        </div>
    </div>
@endsection
