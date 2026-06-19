@extends('layouts.main_layout')
@section('content')
    <!-- Fundo Creme Zen (Inspirado em papel Washi/estética de Seul) -->
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center py-5" style="background-color: #f7f6f2;">
        <div class="row justify-content-center w-100">
            <div class="col-xl-4 col-lg-5 col-md-7 col-sm-9">

                <!-- Estrutura limpa, sem sombras pesadas, focada em linhas e tipografia -->
                <div class="p-4 p-md-5 bg-white" style="border: 1px solid #e5e3dd;">

                    <!-- Cabeçalho Tipográfico Oriental -->
                    <div class="mb-5 d-flex justify-content-between align-items-baseline border-bottom pb-3" style="border-color: #e5e3dd !important;">
                        <div>
                            <!-- Nome do sistema com muito espaçamento -->
                            <h1 class="h5 text-dark fw-bold mb-0 tracking-oriental">NOTES</h1>
                            <span class="text-muted d-block mt-1" style="font-size: 0.65rem; letter-spacing: 0.05em;">SISTEMA DE NOTAS</span>
                        </div>
                        <!-- Um detalhe sutil que remete à numeração de páginas/capítulos orientais -->
                        <span class="text-muted small fw-light" style="font-family: monospace;">v1.0 //</span>
                    </div>

                    <!-- Formulário -->
                    <form action="/loginSubmit" method="post" novalidate autocomplete="off">
                        @csrf

                        <!-- Campo de Email -->
                        <div class="mb-4">
                            <label for="login-email" class="form-label text-dark fw-semibold small tracking-oriental mb-2">EMAIL</label>
                            <input type="email" class="form-control oriental-input px-3 py-2.5 rounded-0"
                                   id="login-email"
                                   name="login_email"
                                   value="{{ old('login_email') }}"
                                   placeholder="exemplo@notes.com"
                                   required>

                            @error('login_email')
                            <div class="text-oriental-error small mt-2 fw-light">
                                ［ {{ $message }} ］
                            </div>
                            @enderror
                        </div>

                        <!-- Campo de Senha -->
                        <div class="mb-5">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="login-password" class="form-label text-dark fw-semibold small tracking-oriental mb-0">SENHA</label>
                            </div>
                            <input type="password" class="form-control oriental-input px-3 py-2.5 rounded-0"
                                   id="login-password"
                                   name="login_password"
                                   placeholder="••••••••"
                                   required>

                            @error('login_password')
                            <div class="text-oriental-error small mt-2 fw-light">
                                ［ {{ $message }} ］
                            </div>
                            @enderror
                        </div>

                        <!-- Botão de Ação Sólido / Alto Contraste -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-oriental-dark w-100 rounded-0 py-3 text-uppercase fw-bold">
                                Entrar no Sistema
                            </button>
                        </div>
                    </form>

                    <!-- Informar erro de login -->
                    @if(session('loginError'))
                        <div class="text-oriental-error small mt-2 fw-light">
                            ［ {{ session('loginError') }} ］
                        </div>
                    @endif

                    <!-- Rodapé -->
                    <div class="mt-5 pt-3 d-flex justify-content-between text-muted" style="font-size: 0.65rem; border-top: 1px dashed #e5e3dd;">
                        <span class="tracking-oriental">&copy; {{ date('Y') }} NOTES STUDIO</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Estilos da Estética Minimalista Oriental -->
    <style>
        /* Espaçamento de letras típico de marcas de design asiáticas (como MUJI) */
        .tracking-oriental {
            letter-spacing: 0.2em;
            font-size: 0.75rem;
        }

        /* Inputs com bordas finas e cantos retos (rounded-0) */
        .oriental-input {
            background-color: #faf9f6 !important;
            border: 1px solid #dcdad4 !important;
            color: #1a1a1a !important;
            font-size: 0.9rem;
            transition: all 0.25s ease;
        }
        .oriental-input::placeholder {
            color: #b5b2aa !important;
        }
        /* O foco substitui a cor por um preto absoluto e elegante, sem sombras coloridas */
        .oriental-input:focus {
            background-color: #ffffff !important;
            border-color: #1a1a1a !important;
            box-shadow: none !important;
            outline: none;
        }

        /* Botão em Bloco Preto Absoluto (Estética Brutalista/Minimalista de Seul) */
        .btn-oriental-dark {
            background-color: #1a1a1a;
            color: #ffffff;
            border: 1px solid #1a1a1a;
            font-size: 0.8rem;
            letter-spacing: 0.15em;
            transition: all 0.25s ease;
        }
        .btn-oriental-dark:hover {
            background-color: #ffffff;
            color: #1a1a1a;
            border-color: #1a1a1a;
        }

        /* Erro sutil delimitado por colchetes orientais ［ ］ */
        .text-oriental-error {
            color: #c93b2b;
            letter-spacing: 0.05em;
        }
    </style>
@endsection
