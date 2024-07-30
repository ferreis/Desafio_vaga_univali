<!-- Inicia um layout chamado "Editar o produto" -->
<x-layout title="Editar o produto">

    <!-- Inclui um formulário de produto -->
    <!--
        :action define a rota para onde o formulário será enviado, usando o método route para gerar a URL de atualização de produtos.
        $index é passado como um parâmetro para a rota, que normalmente representa o identificador do produto que está sendo editado.
    -->
    <!--
        :produto passa a variável $produto para o componente, contendo os dados do produto que está sendo editado.
    -->
    <!--
        :update define se o formulário está em modo de atualização (true neste caso), o que pode alterar a lógica ou a apresentação do formulário.
    -->
    <x-produto.form :action="route('produtos.update', $index)" :produto="$produto" :produto="old('nome_Name')" :update="true"></x-produto.form>
</x-layout>
