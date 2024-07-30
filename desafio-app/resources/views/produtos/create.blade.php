<!-- Inicia um layout chamado "Novo produto" -->
<x-layout title="Novo produto">

    <!-- Inclui um formulário de produto -->
    <!--
        :action define a rota para onde o formulário será enviado, usando o método route para gerar a URL de criação de novos produtos.
    -->
    <!--
        :nameInput passa o valor antigo do campo nameInput ao formulário, utilizando a função old() para reter os dados do formulário após um erro de validação.
    -->
    <!--
        :update define se o formulário está em modo de atualização (false neste caso), o que indica que o formulário está em modo de criação de um novo produto.
    -->
    <x-produto.form
        :action="route('produtos.store')"
        :recuperar="old('nome_Id')"
        :update="false"
    ></x-produto.form>
</x-layout>
