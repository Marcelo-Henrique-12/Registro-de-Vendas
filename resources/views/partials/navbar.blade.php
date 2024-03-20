<nav class="navbar navbar-expand-md sticky-top custom-navbar" data-bs-theme="">
    <div class="container">
        <a class="navbar-brand d-md-none" href="#">
            <svg class="bi" width="24" height="24">
                <use xlink:href="#aperture" />
            </svg>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"
            aria-controls="offcanvas" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasLabel">Fechar Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav flex-grow-1 justify-content-between">

                    <li class="nav-item"><a class="nav-link" href="{{ route('venda.create') }}">Cadastrar venda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('venda.index') }}">Vendas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cliente.index') }}">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('produto.index') }}">Produtos</a></li>



                    <li class="nav-item dropdown">
                        <a id="profileNavLink" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">Meu Perfil</a>
                            <a class="dropdown-item" href="#">Alterar Senha</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                    {{-- <li class="nav-item">
                        <button id="toggle-theme" class="btn btn-link nav-link" onclick="toggleTheme()">
                            <i id="theme-icon" class="far fa-moon"></i>
                        </button>
                    </li> --}}
                </ul>

            </div>
        </div>
    </div>
</nav>
