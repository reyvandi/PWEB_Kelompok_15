<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i class="fas fa-leaf me-2"></i>Sahabat Ladang
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-home me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('monitoring-lahan') ? 'active' : '' }}" href="{{ route('monitoring.lahan') }}">
                        <i class="fas fa-chart-line me-1"></i>Monitoring Lahan
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ Request::is('lahan/create') ? 'active' : '' }}" href="{{ route('lahan.create') }}">
                        <i class="fas fa-plus me-1"></i>Tambah Lahan
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('profil') ? 'active' : '' }}" href="{{ route('profil') }}">
                        <i class="fas fa-user-circle me-1"></i>Profil
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


