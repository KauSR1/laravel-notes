<!-- Grid/Lista de Notas -->
<!-- row: Cria uma linha do sistema de grid do Bootstrap para envelopar as colunas. -->
<!-- g-4: Adiciona um espaçamento (gutter) de nível 4 entre os cards caso fiquem lado a lado. -->
<div class="row g-4">

    <!-- col-12: Define que cada nota ocupará a largura total da linha (perfeito para leitura linear). -->
    <div class="col-12">

        <!-- Card de Nota Minimalista -->
        <!-- p-4 p-md-5: Espaçamento interno. p-4 em telas pequenas e p-5 em telas médias/grandes (MD). -->
        <!-- bg-white: Fundo branco puro para contrastar com o fundo creme do site. -->
        <!-- rounded-0: Remove as bordas arredondadas do Bootstrap, mantendo os cantos retos e geométricos. -->
        <!-- border: Cria a borda fina com a cor cinza-zen personalizada para delimitar o card sem pesar. -->
        <div class="p-4 p-md-5 bg-white rounded-0" style="border: 1px solid #e5e3dd;">

            <!-- Cabeçalho do Card (Título, Data e Botões) -->
            <!-- align-items-start: Alinha os itens do topo pela parte superior. -->
            <!-- border-bottom pb-3 mb-4: Cria uma linha divisória inferior interna, com padding inferior 3 e margem inferior 4 para separar o título do texto. -->
            <div class="row align-items-start border-bottom pb-3 mb-4" style="border-color: #e5e3dd !important;">

                <!-- Área de Informações da Nota (Título e Data) -->
                <!-- col: Ocupa de forma automática todo o espaço restante à esquerda dos botões. -->
                <div class="col">
                    <!-- Título em Alta legibilidade e Caixa Alta Sutil -->
                    <!-- text-dark fw-bold: Texto em tom escuro quase preto e em negrito para destaque. -->
                    <!-- tracking-oriental: Aplica o espaçamento de letras maior (definido no seu CSS personalizado). -->
                    <!-- mb-2: Pequeno espaço de nível 2 abaixo do título, empurrando a data um pouco para baixo. -->
                    <h4 class="text-dark fw-bold tracking-oriental mb-2" style="font-size: 1.1rem;">
                        {{ $note['title'] }}
                    </h4>

                    <!-- Data estilo timestamp limpo -->
                    <!-- text-muted d-block: Cor cinza suave e força a tag small a se comportar como bloco (pulando linha). -->
                    <!-- font-family: monospace: Fonte estilo código/máquina de escrever, que traz um visual bem "studio minimalista". -->
                    <small class="text-muted d-block" style="font-size: 0.7rem; font-family: monospace;">
                        created:
                        {{ date('Y-m-d-m H:i:s', strtotime($note['created_at'])) }}
                    </small>
                    @if($note['created_at'] != $note['updated_at'])
                        <small class="text-muted d-block" style="font-size: 0.7rem; font-family: monospace;">
                            edit:
                            {{ date('Y-m-d-m H:i:s', strtotime($note['updated_at'])) }}
                        </small>
                    @endif
                </div>

                <!-- Área de Ações (Botões de Editar e Deletar) -->
                <!-- col-auto text-end: Ocupa apenas a largura exata dos botões e joga todo o conteúdo para a direita. -->
                <div class="col-auto text-end">
                    <!-- Botão de Editar -->
                    <!-- btn-oriental-outline: Usa o estilo customizado cinza/borda fina criado no seu CSS. -->
                    <!-- btn-sm rounded-0 mx-1: Botão no tamanho pequeno, sem bordas arredondadas e com leve espaçamento nas laterais (eixo X). -->
                    <a href="{{Route('editNote', ['id' => Crypt::encrypt($note['id'])])}}" class="btn btn-oriental-outline btn-sm rounded-0 mx-1" title="Edit">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>

                    <!-- Botão de Deletar -->
                    <!-- btn-oriental-danger: Usa o estilo customizado vermelho sutil que você criou no CSS para ações críticas. -->
                    <a href="{{Route('del', ['id' => Crypt::encrypt($note['id'])])}}" class="btn btn-oriental-danger btn-sm rounded-0 mx-1" title="Delete">
                        <i class="fa-regular fa-trash-can"></i>
                    </a>
                </div>
            </div>

            <!-- Corpo do Texto com espaçamento confortável -->
            <!-- fw-light: Fonte mais fina e leve, muito usada no minimalismo para não cansar os olhos. -->
            <!-- lh-lg: Line-Height Large (espaçamento maior entre as linhas do texto, excelente para leitura de notas textuais). -->
            <!-- mb-0: Remove a margem padrão inferior do parágrafo, deixando que o card seja fechado pelo padding original. -->
            <!-- text-align: justify: Alinha o texto de forma blocada nas duas extremidades (esquerda e direita), simulando o visual de livros ou páginas de jornal antigas. -->
            <p class="text-dark fw-light lh-lg mb-0" style="font-size: 0.95rem; color: #4a4a4a !important; text-align: justify;">
                {{ $note['description'] }}
            </p>
        </div>
    </div>
</div>
