<header class="bg-white border-bottom border-dark mb-4">
    <nav class="navbar py-3 overflow-auto">
        <div class="container d-flex justify-content-between align-items-center flex-nowrap" style="min-width: 800px;">
            
            <!-- 1. Lado Esquerdo: Mensagem de Boas Vindas -->
            <div class="w-100 d-flex justify-content-start">
                @if(session()->has('user'))
                    <span class="text-dark fw-bold m-0" style="cursor: default;">
                        Olá, {{ session('user')['name'] ?? 'Usuário' }}
                    </span>
                @endif
            </div>

            <!-- 2. Centro: Logo Centralizada -->
            <a class="navbar-brand w-100 d-flex justify-content-center align-items-center gap-2 text-dark fw-bolder fs-4 m-0" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/icon.png') }}" alt="Ícone Habit" height="35">
                Habit
            </a>

            <!-- 3. Lado Direito: Botões e Links -->
            <div class="w-100 d-flex justify-content-end align-items-center gap-3">
                @if(session()->has('user'))
                    
                    @if (session('user.is_anunciante'))
                        <a href="{{ route('anuncios.meus') }}" class="text-dark fw-bold text-decoration-none">Meus Anúncios</a>
                        <a href="{{ route('anuncios.create') }}" class="btn btn-outline-dark rounded-pill border-dark fw-bold px-3 text-nowrap">
                            + Novo Anúncio
                        </a>
                    @endif
                    
                    <a href="{{ route('logout') }}" class="btn btn-dark rounded-pill border-dark fw-bold px-4">Sair</a>
                    
                @else
                    
                    <a href="{{ route('login') }}" class="text-dark fw-bold text-decoration-none">Entrar</a>
                    <a href="{{ route('register') }}" class="btn btn-dark rounded-pill border-dark fw-bold px-4 text-nowrap">Cadastre-se</a>
                    
                @endif
            </div>
            
        </div>
    </nav>
</header>