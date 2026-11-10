<aside class="app-sidebar" id="navigation" aria-label="Navegação principal">
    <div class="sidebar-brand">
        <a href="{{ url('/') }}" class="brand-link">
            <span class="app-brand-mark"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
            <span class="brand-text">Painel</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column">
                <li class="nav-header">MENU PRINCIPAL</li>

                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                       @if (request()->is('/')) aria-current="page" @endif>
                        <i class="nav-icon bi bi-house-door" aria-hidden="true"></i>
                        <p>Início</p>
                    </a>
                </li>

                @if (auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                           class="nav-link {{ request()->routeIs('admin.users.index', 'admin.users.show', 'admin.users.resetForm', 'admin.users.reset') ? 'active' : '' }}"
                           @if (request()->routeIs('admin.users.index', 'admin.users.show', 'admin.users.resetForm', 'admin.users.reset')) aria-current="page" @endif>
                            <i class="nav-icon bi bi-people" aria-hidden="true"></i>
                            <p>Lista de usuários</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.create') }}" class="nav-link">
                            <i class="nav-icon bi bi-person-plus" aria-hidden="true"></i>
                            <p>Novo usuário</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
