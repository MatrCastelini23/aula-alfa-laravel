<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('admin.users.index') }}" class="brand-link">
            <span class="brand-text fw-light">MENU</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" role="menu">
                <li class="nav-header">MENU</li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>Lista de usuários</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-person-gear"></i>
                        <p>Editar perfil</p>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Sair
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
