<!-- Grid de Notas -->
<div class="row g-4">
    <div class="col-12">

        <!-- Card da nota -->
        <div class="p-4 p-md-5 bg-white rounded-0" style="border: 1px solid #e5e3dd;">

            <!-- Cabeçalho (Título, Datas e Botões) -->
            <div class="row align-items-start border-bottom pb-3 mb-4" style="border-color: #e5e3dd !important;">

                <!-- Título e Datas -->
                <div class="col">
                    {{-- Título da nota --}}
                    <h4 class="text-dark fw-bold tracking-oriental mb-2" style="font-size: 1.1rem;">
                        {{ $note['title'] }}
                    </h4>

                    {{-- Data de criação --}}
                    <small class="text-muted d-block" style="font-size: 0.7rem; font-family: monospace;">
                        created:
                        {{ date('Y-m-d H:i:s', strtotime($note['created_at'])) }}
                    </small>

                    {{-- Data de edição (se houver alteração) --}}
                    @if($note['created_at'] != $note['updated_at'])
                        <small class="text-muted d-block" style="font-size: 0.7rem; font-family: monospace;">
                            edit:
                            {{ date('Y-m-d H:i:s', strtotime($note['updated_at'])) }}
                        </small>
                    @endif
                </div>

                <!-- Botões de ação -->
                <div class="col-auto text-end">
                    {{-- Editar nota (envia ID criptografado) --}}
                    <a href="{{Route('editNote', ['id' => Crypt::encrypt($note['id'])])}}" class="btn btn-oriental-outline btn-sm rounded-0 mx-1" title="Edit">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>

                    {{-- Deletar nota (envia ID criptografado) --}}
                    <a href="{{Route('del', ['id' => Crypt::encrypt($note['id'])])}}" class="btn btn-oriental-danger btn-sm rounded-0 mx-1" title="Delete">
                        <i class="fa-regular fa-trash-can"></i>
                    </a>
                </div>
            </div>

            <!-- Conteúdo da nota -->
            <p class="text-dark fw-light lh-lg mb-0" style="font-size: 0.95rem; color: #4a4a4a !important; text-align: justify;">
                {{ $note['description'] }}
            </p>
        </div>
    </div>
</div>
