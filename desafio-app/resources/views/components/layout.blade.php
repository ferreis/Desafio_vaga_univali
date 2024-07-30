<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Meta tags essenciais para responsividade e compatibilidade -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Link para o arquivo CSS compilado -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-9kx3olKa.css') }}">

    <!-- Scripts JavaScript compilados -->
    <script type="text/javascript" src="{{ asset('build/assets/app-DiaGsIN1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('resources/js/app.js') }}"></script>

    <!-- Título da página dinâmico -->
    <title>{{ $title }} - Desafio</title>
</head>
<body class="d-flex min-vh-100">
<!-- Menu lateral -->
<x-navbar></x-navbar>

<!-- Container principal-->
<div class="container mt-3 h-auto w-auto">
    <h1 class="mb-3">{{ $title }}</h1>

    <!-- Se tiver erro, exibe mensagens,  -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Slot para inserir o conteúdo da página -->
    {{ $slot }}
</div>
</body>
</html>
