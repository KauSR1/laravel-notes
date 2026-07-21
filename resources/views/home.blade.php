@extends('layouts.main_layout')
@section('content')
    <!-- Fundo da tela -->
    <div class="container-fluid min-vh-100 py-5" style="background-color: #f7f6f2;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    {{-- Barra superior (boas-vindas / logout) --}}
                    @include('top_bar')

                    <!-- Se não houver notas criadas -->
                    @if(count($notes) == 0)
                        <div class="p-5 bg-white text-center mb-4" style="border: 1px solid #e5e3dd;">
                            <p class="text-muted fw-light my-4 tracking-oriental" style="font-size: 0.9rem;">
                                ［ You have no notes available! ］
                            </p>
                            {{-- Botão para criar a primeira nota --}}
                            <a href="{{ route('newNote') }}" class="btn btn-oriental-dark rounded-0 py-3 px-5 text-uppercase fw-bold my-3">
                                <i class="fa-regular fa-pen-to-square me-2"></i> Create Your First Note
                            </a>
                        </div>
                    @else

                        <!-- Separador estilizado -->
                        <div class="d-flex align-items-center my-5">
                            <div class="flex-grow-1" style="border-top: 1px dashed #e5e3dd;" aria-hidden="true"></div>
                            <span class="mx-3 text-muted" style="font-size: 0.65rem; letter-spacing: 0.3em;">EXISTING ENTRIES</span>
                            <div class="flex-grow-1" style="border-top: 1px dashed #e5e3dd;" aria-hidden="true"></div>
                        </div>

                        <!-- Botão para criar nova nota -->
                        <div class="d-flex justify-content-end mb-4">
                            <a href="{{ route('newNote') }}" class="btn btn-oriental-dark rounded-0 py-2 px-4 text-uppercase fw-bold">
                                <i class="fa-regular fa-pen-to-square me-2"></i> New Note
                            </a>
                        </div>

                        {{-- Loop para listar cada nota existente --}}
                        @foreach($notes as $note)
                            @include('note')
                        @endforeach
                    @endif

                    <!-- Rodapé -->
                    <div class="mt-5 pt-3 d-flex justify-content-between text-muted" style="font-size: 0.65rem; border-top: 1px dashed #e5e3dd;">
                        <span class="tracking-oriental">&copy; {{ date('Y') }} NOTES STUDIO</span>
                        <span style="font-family: monospace;">STAY MINIMAL</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Estilos CSS customizados dos botões -->
    <style>
        .tracking-oriental {
            letter-spacing: 0.15em;
        }

        /* Botão principal (Criar) */
        .btn-oriental-dark {
            background-color: #1a1a1a;
            color: #ffffff;
            border: 1px solid #1a1a1a;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            transition: all 0.25s ease;
        }
        .btn-oriental-dark:hover {
            background-color: #ffffff;
            color: #1a1a1a;
            border-color: #1a1a1a;
        }

        /* Botão secundário */
        .btn-oriental-outline {
            background-color: transparent;
            color: #555554;
            border: 1px solid #dcdad4;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            transition: all 0.25s ease;
        }
        .btn-oriental-outline:hover {
            background-color: #1a1a1a;
            color: #ffffff;
            border-color: #1a1a1a;
        }

        /* Botão perigo (Deletar) */
        .btn-oriental-danger {
            background-color: transparent;
            color: #c93b2b;
            border: 1px solid #f2dedc;
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
