<x-layout title="Lista de produtos">
    <!-- Link para adicionar um novo produto -->
    <a href="{{ route('produtos.create') }}" class="btn btn-dark mb-2">Adicionar</a>

    <!-- Tabela para listar os produtos -->
    <table class="table table-striped table-bordered text-center">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Unidade de Medida</th>
            <th class="align-items-center">Quantidade</th>
            <th>Preço</th>
            <th>Perecível</th>
            <th>Data de Validade</th>
            <th>Data de Fabricação</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($produtos as $index => $produto)
            <tr>
                <td>{{ $produto['nome'] }}</td>
                <td>{{ $produto['unidade'] }}</td>
                <td>{{ $produto['quantidade'] }} {{ mb_substr($produto['unidade'], -3, 2) }}</td>
                <td>{{ $produto['preco'] }}</td>
                <td>
                    {{ $produto['perecivel'] ? "️✔️"  : "❌" }}
                </td>
                <td @if ($produto['vencido'] && $produto['dtValidade']!=null)? class="bg-danger bg-opacity-50" @endif>
                    @if($produto['dtValidade']!=null)
                        @if ($produto['vencido'])
                            Vencido em
                        @endif
                    <div>{{ date("d/m/Y", strtotime(trim($produto['dtValidade'], '"'))) }}</div>
                        @endif

                </td>
                <td>{{ date("d/m/Y", strtotime($produto['dtFabricacao'])) }}</td>
                <td class="">
                        <span class="d-flex justify-content-center">
                            <!-- botão para editar o produto -->
                            <a href="{{ route('produtos.edit', $index) }}" class="btn btn-primary btn-sm me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-gear" viewBox="0 0 16 16">
                                    <path
                                        d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                                    <path
                                        d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                                </svg>
                            </a>
                            <!-- Botão para deletar o produto selecionado-->
                            <form action="{{ route('produtos.destroy', $index) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="index">
                                <button class="btn btn-danger btn-sm">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-trash"
                                         viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                            </form>
                        </span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
