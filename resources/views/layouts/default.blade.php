<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f4f7fb">
    <title>@yield('title', 'Aula Alfa')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="layout-fixed sidebar-expand-lg app-shell">
    <div class="app-wrapper">
        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')
        <main class="app-main" id="main">
            @yield('content')
        </main>
    </div>
</body>
</html>
