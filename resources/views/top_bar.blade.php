<!-- CABEÇALHO DA PÁGINA -->
<!-- Caixa principal branca com borda zen sutil e padding responsivo (maior no desktop). -->
<div class="p-4 p-md-5 bg-white mb-4" style="border: 1px solid #e5e3dd;">
    <div class="row align-items-center gy-3">

        <!-- Bloco da Esquerda: Logo e Subtítulo -->
        <!-- col-md-auto: Ocupa apenas o espaço necessário do texto e se alinha à esquerda no desktop. -->
        <div class="col-md-auto text-center text-md-start">
            <a href="{{ route('home') }}" class="d-inline-block text-decoration-none mb-1">
                <h1 class="h5 text-dark fw-bold mb-0 tracking-oriental">NOTES</h1>
            </a>
            <span class="text-muted d-block mt-1" style="font-size: 0.65rem; letter-spacing: 0.05em;">A SIMPLE LARAVEL PROJECT</span>
        </div>

        <!-- Bloco Central: Indicador de Ambiente -->
        <!-- col-md: Preenche o centro da tela e centraliza a tag "[ workspace ]". -->
        <div class="col-md text-center">
            <span class="text-muted small fw-light italic" style="font-family: monospace;">[ workspace ]</span>
        </div>

        <!-- Bloco da Direita: Usuário e Botão de Sair -->
        <!-- col-md-auto: Empurra o conteúdo para a extremidade direita no desktop. -->
        <div class="col-md-auto">
            <div class="d-flex justify-content-center justify-content-md-end align-items-center gap-3">
                <!-- E-mail do usuário: text-truncate e max-width evitam que e-mails longos quebrem o layout. -->
                <span class="small text-dark fw-semibold tracking-oriental text-truncate" style="font-size: 0.75rem; max-width: 200px;">
                    <i class="fa-solid fa-user-circle me-2 opacity-50"></i>{{ session('user.email') }}
                </span>
                <!-- Botão Logout: Estilo oriental outline, limpo e em caixa alta. -->
                <a href="{{ route('logout') }}" class="btn btn-oriental-outline btn-sm rounded-0 px-3 text-uppercase fw-bold">
                    Logout <i class="fa-solid fa-arrow-right-from-bracket ms-1" style="font-size: 0.7rem;"></i>
                </a>
            </div>
        </div>

    </div>
</div>
