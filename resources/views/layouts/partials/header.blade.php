<nav class="app-header navbar navbar-expand" aria-label="Barra superior">
    <div class="container-fluid">
        <a class="app-header-brand" href="{{ url('/') }}">
            <span class="app-brand-mark"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
            <span>Aula Alfa</span>
        </a>

        <div class="app-header-account">
            <span class="app-user-avatar" aria-hidden="true">
                {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
            </span>
            <span class="app-user-name">{{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-box-arrow-right me-1" aria-hidden="true"></i>
                    Sair
                </button>
            </form>
        </div>
    </div>
</nav>
