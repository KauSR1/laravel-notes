@extends('layouts.main_layout')
@section('content')
    <!-- Fundo Creme Zen (Inspirado em papel Washi/estética de Seul) -->
    <div class="container-fluid min-vh-100 py-5" style="background-color: #f7f6f2;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    @include('top_bar')

                    <!-- SEPARADOR ESTILIZADO -->
                    <div class="d-flex align-items-center my-5">
                        <div class="flex-grow-1" style="border-top: 1px dashed #e5e3dd;" aria-hidden="true"></div>
                        <span class="mx-3 text-muted" style="font-size: 0.65rem; letter-spacing: 0.3em;">CONFIRM ACTION</span>
                        <div class="flex-grow-1" style="border-top: 1px dashed #e5e3dd;" aria-hidden="true"></div>
                    </div>

                    <!-- CARD DE CONFIRMAÇÃO DE EXCLUSÃO -->
                    <div class="p-4 p-md-5 bg-white mb-4 text-center" style="border: 1px solid #e5e3dd;">

                        <!-- Ícone Sutil em tom de Alerta Soft -->
                        <div class="mb-4">
                            <span class="d-inline-flex justify-content-center align-items-center"
                                  style="width: 64px; height: 64px; background-color: #fdf6f0; border: 1px solid #f7e3d3; color: #d97706;">
                                <i class="fa-solid fa-triangle-exclamation fs-4"></i>
                            </span>
                        </div>

                        <!-- Título e Mensagem -->
                        <h2 class="h5 mb-2 fw-normal tracking-oriental text-uppercase" style="color: #1a1a1a; font-size: 0.95rem;">
                            ［ {{ $note->title ?? '[Note Title]' }} ］
                        </h2>

                        <p class="text-muted small mb-5 fw-light" style="font-size: 0.85rem;">
                            Are you sure you want to permanently delete this note?
                        </p>

                        <!-- Ações / Botões -->
                        <div class="d-flex justify-content-center gap-3 pt-4" style="border-top: 1px dashed #f0eee9;">
                            <a href="{{ route('home') }}" class="btn btn-oriental-outline py-2 px-4 text-uppercase">
                                <i class="fa-solid fa-xmark me-2"></i>No, Keep It
                            </a>
                            <a href="{{ route('deleteNoteConfirm', ['id' => Crypt::encrypt($note->id ?? 0)]) }}"
                               class="btn btn-oriental-danger py-2 px-4 text-uppercase fw-bold">
                                <i class="fa-solid fa-trash me-2"></i>Yes, Delete
                            </a>
                        </div>
                    </div>

                    <!-- Rodapé da Área Logada -->
                    <div class="mt-5 pt-3 d-flex justify-content-between text-muted" style="font-size: 0.65rem; border-top: 1px dashed #e5e3dd;">
                        <span class="tracking-oriental">&copy; {{ date('Y') }} NOTES STUDIO</span>
                        <span style="font-family: monospace;">STAY MINIMAL</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Estilos Unificados da Estética Minimalista Oriental -->
    <style>
        .tracking-oriental {
            letter-spacing: 0.15em;
        }

        /* Botões Customizados */
        .btn-oriental-outline {
            background-color: transparent;
            color: #555554;
            border: 1px solid #dcdad4;
            border-radius: 0;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            transition: all 0.25s ease;
        }
        .btn-oriental-outline:hover {
            background-color: #1a1a1a;
            color: #ffffff;
            border-color: #1a1a1a;
        }

        .btn-oriental-danger {
            background-color: #c93b2b;
            color: #ffffff;
            border: 1px solid #c93b2b;
            border-radius: 0;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            transition: all 0.25s ease;
        }
        .btn-oriental-danger:hover {
            background-color: #a72e21;
            color: #ffffff;
            border-color: #a72e21;
        }
    </style>
@endsection
