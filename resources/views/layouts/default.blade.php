<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@hasSection('hide-sidebar')
<body class="@yield('classe-body')">
    @yield('content')
@else
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary @yield('classe-body')">
    <div class="app-wrapper">
        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')
        <main class="app-main">
            @yield('content')
        </main>
    </div>
@endif
    @vite('resources/js/app.js')
</body>
</html>
