<!-- Cabeçalho da página (Barra superior) -->
<div class="p-4 p-md-5 bg-white mb-4" style="border: 1px solid #e5e3dd;">
    <div class="row align-items-center gy-3">

        <!-- Logo e subtítulo -->
        <div class="col-md-auto text-center text-md-start">
            <a href="{{ route('home') }}" class="d-inline-block text-decoration-none mb-1">
                <h1 class="h5 text-dark fw-bold mb-0 tracking-oriental">NOTES</h1>
            </a>
            <span class="text-muted d-block mt-1" style="font-size: 0.65rem; letter-spacing: 0.05em;">A SIMPLE LARAVEL PROJECT</span>
        </div>

        <!-- Indicador central -->
        <div class="col-md text-center">
            <span class="text-muted small fw-light italic" style="font-family: monospace;">[ workspace ]</span>
        </div>

        <!-- Usuário logado e Logout -->
        <div class="col-md-auto">
            <div class="d-flex justify-content-center justify-content-md-end align-items-center gap-3">
                {{-- E-mail do usuário vindo da sessão --}}
                <span class="small text-dark fw-semibold tracking-oriental text-truncate" style="font-size: 0.75rem; max-width: 200px;">
                    <i class="fa-solid fa-user-circle me-2 opacity-50"></i>{{ session('user.email') }}
                </span>
                {{-- Botão de logout --}}
                <a href="{{ route('logout') }}" class="btn btn-oriental-outline btn-sm rounded-0 px-3 text-uppercase fw-bold">
                    Logout <i class="fa-solid fa-arrow-right-from-bracket ms-1" style="font-size: 0.7rem;"></i>
                </a>
            </div>
        </div>

    </div>
</div>
