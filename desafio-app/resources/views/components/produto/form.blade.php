<form action="{{ $action }}" method="post" class="d-grid g-3 px-5 align-items-lg-end align-items-center">
    <!-- Adiciona um token CSRF para proteção contra ataques CSRF -->
    @csrf

    <!-- Se for uma atualização, utiliza o método PUT -->
    @if($update)
        @method('PUT')
    @endif

    <!-- Campo para o nome do item -->
    <div class="row mb-3">
        <div class="col mb-3">
            <label for="nome_Id" class="form-label">Nome do item:</label>
            <input type="text" id="nome_Id" name="nome_Name" class="form-control"
                   @isset($produto)
                       value="{{ $produto['nome'] }}"
                @endisset>
        </div>
    </div>

    <!-- Campos para perecibilidade, unidade de medida, quantidade e preço -->
    <div class="row mb-3 justify-content-between align-items-center">
        <!-- Campo para produto perecível -->
        <div class="col form-switch form-check-inline">
            <label class="form-label" for="perecivel_Id">Produto perecível:</label>
            <input class="col m-1 form-check-input form-check-input" value="{{true}}" type="checkbox" id="perecivel_Id" name="perecivel_Name"
                {{ old("perecivel_Name") ? "checked" : '' }}
            @isset($produto)
                {{ $produto['perecivel'] ? "checked" : '' }}
                @endisset>
        </div>

        <!-- Campo para unidade de medida -->
        <div class="col form-select">
            <label for="unidadeMedida_Id">Unidade de medida:</label>
            <select id="unidadeMedida_Id" name="unidadeMedida_Name" class="form-select">
                @foreach(\App\UnidadeMedida::cases() as $unMedida)
                    <option value="{{ $unMedida->value }}"
                    @isset($produto)
                        {{ $produto['unidade'] === $unMedida->value ? 'selected' : '' }}
                        @endisset>
                        {{ $unMedida->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo para quantidade -->
        <div class="col">
            <label for="quantidade_Id" class="form-label">Quantidade:</label>
            <input type="number" id="quantidade_Id" name="quantidade_Name" class="form-control"
                   @isset($produto)
                       value="{{ $produto['quantidade'] }}"
                @endisset>
        </div>

        <!-- Campo para preço -->
        <div class="col-3">
            <label for="price_Id" class="form-label">Preço:</label>
            <input type="text" id="price_Id" name="preco_Name" class="form-control"
                   @isset($produto)
                       value="{{ $produto['preco'] }}"
                @endisset>
        </div>
    </div>

    <!-- Campos para data de validade e data de fabricação -->
    <div class="row mb-3">
        <div class="col">
            <label for="dtValidade_Id" class="form-label">Data de validade:</label>
            <input type="date" id="dtValidade_Id" name="dtValidade_Name" class="form-control"
                   @isset($produto)
                       value="{{ date('Y-m-d', strtotime($produto['dtValidade'])) }}"
                @endisset>
        </div>
        <div class="col">
            <label for="dtFabricacao_Id" class="form-label">Data de fabricação:</label>
            <input type="date" id="dtFabricacao_Id" name="dtFabricacao_Name" class="form-control"
                   @isset($produto)
                       value="{{ date('Y-m-d', strtotime($produto['dtFabricacao'])) }}"
                @endisset>
        </div>
    </div>

    <!-- Botões de ação -->
    <div class="d-flex">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('produtos.index') }}" class="btn btn-danger ms-2">Cancelar</a>
    </div>
</form>
<script>
    // Obtém referências para os elementos do formulário
    const unidadeMedidaSelect = document.getElementById('unidadeMedida_Id');
    const quantidadeInput = document.getElementById('quantidade_Id');
    const priceInput = document.getElementById('price_Id');

    // Formata o preço como moeda quando o usuário digita
    priceInput.addEventListener('input', formatCurrency);

    function formatCurrency() {
        // Remove caracteres não numéricos e converte para reais
        const value = parseFloat(priceInput.value.replace(/\D/g, '')) / 100;
        // Formata o valor como moeda
        const formattedValue = value.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
        priceInput.value = formattedValue;
    }

    // Atualiza o campo de quantidade com base na unidade de medida selecionada
    unidadeMedidaSelect.addEventListener('change', () => {
        const selectedOption = unidadeMedidaSelect.options[unidadeMedidaSelect.selectedIndex].text;

        // Ajusta o campo de quantidade com base na unidade de medida selecionada
        switch (selectedOption) {
            case 'Litro (L)':
                quantidadeInput.setAttribute('step', '0.001');
                quantidadeInput.setAttribute('placeholder', 'Quantidade em litros');
                break;
            case 'Quilograma (Kg)':
                quantidadeInput.setAttribute('step', '0.001');
                quantidadeInput.setAttribute('placeholder', 'Quantidade em quilogramas');
                break;
            case 'Unidade (Un)':
                quantidadeInput.setAttribute('step', '1');
                quantidadeInput.setAttribute('placeholder', 'Quantidade em unidades');
                break;
            default:
                quantidadeInput.removeAttribute('step');
                quantidadeInput.setAttribute('placeholder', 'Digite a quantidade');
        }
    });
</script>

