<!-- Container principal para a barra lateral -->
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 100%; max-width: 260px;">

    <!-- Logo e título do menu -->
    <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <!-- Ícone SVG do Bootstrap -->
        <svg class="bi me-2" width="32" height="32"><use xlink:href="#bootstrap"></use></svg>
        <!-- Título do menu -->
        <span class="fs-4">Menu</span>
    </a>
    <hr>

    <!-- Lista de navegação -->
    <ul class="nav nav-pills flex-column mb-auto">

        <!-- Item de navegação: Lista de produtos -->
        <li class="nav-item">
            <a href="{{ route('produtos.index') }}" class="nav-link active" aria-current="page">
                <!-- Ícone SVG para o item -->
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                Lista de produtos
            </a>
        </li>

        <!-- Item de navegação: Cadastro de produto -->
        <li>
            <a href="{{ route('produtos.create') }}" class="nav-link text-white">
                <!-- Ícone SVG para o item -->
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Cadastro de produto
            </a>
        </li>
    </ul>
</div>

