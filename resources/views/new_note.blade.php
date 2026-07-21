@extends('layouts.main_layout')
@section('content')
    <!-- Fundo da tela -->
    <div class="container-fluid min-vh-100 py-5" style="background-color: #f7f6f2;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    {{-- Barra superior (boas-vindas / logout) --}}
                    @include('top_bar')

                    <!-- Separador estilizado -->
                    <div class="d-flex align-items-center my-5">
                        <div class="flex-grow-1" style="border-top: 1px dashed #e5e3dd;" aria-hidden="true"></div>
                        <span class="mx-3 text-muted" style="font-size: 0.65rem; letter-spacing: 0.3em;">NEW ENTRY</span>
                        <div class="flex-grow-1" style="border-top: 1px dashed #e5e3dd;" aria-hidden="true"></div>
                    </div>

                    <!-- Card do formulário -->
                    <div class="p-4 p-md-5 bg-white mb-4" style="border: 1px solid #e5e3dd;">

                        <!-- Cabeçalho com botão fechar -->
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3" style="border-bottom: 1px solid #f0eee9;">
                            <h2 class="h5 mb-0 fw-normal tracking-oriental text-uppercase" style="color: #1a1a1a; font-size: 0.9rem;">
                                ［ Create Note ］
                            </h2>
                            {{-- Cancelar e voltar pra Home --}}
                            <a href="{{ route('home') }}" class="btn btn-oriental-danger px-3 py-1 text-decoration-none" title="Cancel">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </div>

                        <!-- Form de criação de nota -->
                        <form action="{{ route('newNoteSubmit') }}" method="post">
                            @csrf

                            <!-- Campo: Título -->
                            <div class="mb-4">
                                <label class="form-label text-muted small text-uppercase tracking-oriental" style="font-size: 0.65rem;">
                                    Note Title
                                </label>
                                <input type="text"
                                       class="form-control input-oriental"
                                       name="text_title"
                                       value="{{old('text_title')}}"
                                       placeholder="Enter title..."
                                       required>

                                {{-- Erro de validação do título --}}
                                @error('text_title')
                                <div class="text-oriental-error small mt-2 fw-light">
                                    ［ {{ $message }} ］
                                </div>
                                @enderror

                            </div>

                            <!-- Campo: Conteúdo -->
                            <div class="mb-4">
                                <label class="form-label text-muted small text-uppercase tracking-oriental" style="font-size: 0.65rem;">
                                    Note Content
                                </label>
                                <textarea class="form-control input-oriental"
                                          name="text_note"
                                          rows="5"
                                          placeholder="Write your thoughts here..."
                                          required>{{ old('text_note') }}</textarea>

                                {{-- Erro de validação da descrição --}}
                                @error('text_note')
                                <div class="text-oriental-error small mt-2 fw-light">
                                    ［ {{ $message }} ］
                                </div>
                                @enderror

                            </div>

                            <!-- Botões de ação -->
                            <div class="d-flex justify-content-end gap-2 pt-3" style="border-top: 1px dashed #f0eee9;">
                                {{-- Cancelar --}}
                                <a href="{{ route('home') }}" class="btn btn-oriental-outline py-2 px-4 text-uppercase">
                                    <i class="fa-solid fa-ban me-2"></i>Cancel
                                </a>
                                {{-- Salvar nota --}}
                                <button type="submit" class="btn btn-oriental-dark py-2 px-4 text-uppercase fw-bold">
                                    <i class="fa-regular fa-circle-check me-2"></i>Save Entry
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Rodapé -->
                    <div class="mt-5 pt-3 d-flex justify-content-between text-muted" style="font-size: 0.65rem; border-top: 1px dashed #e5e3dd;">
                        <span class="tracking-oriental">&copy; {{ date('Y') }} NOTES STUDIO</span>
                        <span style="font-family: monospace;">STAY MINIMAL</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Estilos CSS customizados dos inputs e botões -->
    <style>
        .tracking-oriental {
            letter-spacing: 0.15em;
        }

        /* Inputs estilizados */
        .input-oriental {
            background-color: #faf9f6 !important;
            border: 1px solid #e5e3dd !important;
            border-radius: 0 !important;
            color: #1a1a1a !important;
            font-size: 0.85rem;
            padding: 0.75rem 1rem;
            transition: all 0.25s ease;
        }
        .input-oriental:focus {
            background-color: #ffffff !important;
            border-color: #1a1a1a !important;
            box-shadow: none !important;
        }
        .input-oriental::placeholder {
            color: #b5b3ac;
            font-size: 0.8rem;
        }

        /* Botão principal (Salvar) */
        .btn-oriental-dark {
            background-color: #1a1a1a;
            color: #ffffff;
            border: 1px solid #1a1a1a;
            border-radius: 0;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            transition: all 0.25s ease;
        }
        .btn-oriental-dark:hover {
            background-color: #ffffff;
            color: #1a1a1a;
            border-color: #1a1a1a;
        }

        /* Botão secundário (Cancelar) */
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

        /* Botão fechar (X) */
        .btn-oriental-danger {
            background-color: transparent;
            color: #c93b2b;
            border: 1px solid #f2dedc;
            border-radius: 0;
            font-size: 0.7rem;
            transition: all 0.25s ease;
        }
        .btn-oriental-danger:hover {
            background-color: #c93b2b;
            color: #ffffff;
            border-color: #c93b2b;
        }
    </style>
@endsection
