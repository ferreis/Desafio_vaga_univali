<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoFormRequest;
use Illuminate\Support\Facades\Storage;

/**
 * Controller responsável pela gestão de produtos.
 *
 * Esta classe controla as operações CRUD (Create, Read, Update, Delete) para produtos,
 * bem como o armazenamento e recuperação de dados de produtos em um arquivo JSON.
 */
class ProdutoController extends Controller
{
    /**
     * Processa e prepara os dados de entrada do formulário para um novo produto.
     *
     * @param  ProdutoFormRequest  $request  Objeto de solicitação do formulário de produto.
     * @return array  Array associativo contendo os dados do produto.
     */
    private function getInputDataProduct(ProdutoFormRequest $request)
    {
        // Atualiza os campos do produto com as informações dos inputs do formulário
        $produto = [
            'nome' => $request->input('nome_Name'),
            'unidade' => $request->input('unidadeMedida_Name'),
            'quantidade' => $request->input('quantidade_Name'),
            'preco' => $request->input('preco_Name'),
            'perecivel' => $request->has('perecivel_Name'),
            'dtValidade' => $request->input('dtValidade_Name'),
            'vencido' => $this->validarDtValidade($request->input('dtValidade_Name')),
            'dtFabricacao' => $request->input('dtFabricacao_Name'),
        ];

        return $produto;
    }

    /**
     * Caminho do arquivo JSON onde os dados dos produtos são armazenados.
     *
     * @var string
     */
    private $localArquivo = 'public/localStorage.json';

    /**
     * Lê o conteúdo do arquivo JSON que contém os dados dos produtos.
     *
     * @return array  Array associativo contendo os dados dos produtos ou um array vazio se o arquivo não existir.
     */
    private function lerArquivoJson()
    {
        if (Storage::disk('local')->exists($this->localArquivo)) {
            $jsonData = Storage::disk('local')->get($this->localArquivo);
            return json_decode($jsonData, true);
        }
        return [];
    }

    /**
     * Salva as informações dos produtos no arquivo JSON.
     *
     * @param  array  $info  Array associativo contendo as informações dos produtos.
     * @return void
     */
    private function salvarArquivoJson($info)
    {
        Storage::disk('local')->put($this->localArquivo, json_encode($info, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    /**
     * Exibe a lista de produtos.
     *
     * @return \Illuminate\View\View  A visualização da lista de produtos.
     */
    public function index()
    {
        $produtos = $this->lerArquivoJson();
        $mensagemSucesso = session('mensagem.sucesso');
        return view('produtos.index')->with('produtos', $produtos)->with('mensagemSucesso', $mensagemSucesso);
    }

    /**
     * Mostrar um formulário para criar um produto.
     *
     * @return \Illuminate\View\View  A visualização do formulário de criação de produto.
     */
    public function create()
    {
        $mensagemErro = session('mensagem.erro');
        return view('produtos.create')->with('mensagemErro', $mensagemErro);
    }

    /**
     * Salva um novo produto e redireciona para a lista de produtos.
     *
     * @param  ProdutoFormRequest  $request  Pega as informações do formulário de produto.
     * @return \Illuminate\Http\RedirectResponse  Redireciona para a lista de produtos com mensagem de sucesso.
     */
    public function store(ProdutoFormRequest $request)
    {
        $listaProduto = $this->lerArquivoJson();
        $novoProduto = $this->getInputDataProduct($request);
        $listaProduto[] = $novoProduto;
        $this->salvarArquivoJson($listaProduto);
        return to_route('produtos.index')->with('mensagem.sucesso', 'Produto cadastrado com sucesso!');
    }

    /**
     * Remove um produto da lista baseado no índice e redireciona para a lista de produtos.
     *
     * @param  int  $index  Índice do produto a ser removido.
     * @return \Illuminate\Http\RedirectResponse  Redireciona para a lista de produtos com mensagem de sucesso.
     */
    public function destroy($index)
    {
        $listaProduto = $this->lerArquivoJson();
        if (is_numeric($index) && $index >= 0 && $index < count($listaProduto)) {
            array_splice($listaProduto, $index, 1);
            $this->salvarArquivoJson($listaProduto);
            return to_route('produtos.index')->with('mensagem.sucesso', 'Produto removida com sucesso da lista');
        }

        return to_route('produtos.index');
    }

    /**
     * redireciona para um formulário para editar um produto.
     *
     * @param  int  $index  Índice do produto a ser editado.
     * @return \Illuminate\View\View  A visualização do formulário de edição de produto.
     */
    public function edit($index)
    {
        $listaProduto = $this->lerArquivoJson();
        $produto = $listaProduto[$index];
        return view('produtos.edit', compact('produto', 'index'));
    }

    /**
     * Atualiza as informações de um produto, e redireciona para a pagina de lista de produtos.
     *
     * @param  ProdutoFormRequest  $request  Pega as informações do formulário de produto.
     * @param  int  $index  Índice do produto a que vai ser atualizado.
     * @return \Illuminate\Http\RedirectResponse  Redireciona para a lista de produtos com mensagem de sucesso.
     */
    public function update(ProdutoFormRequest $request, int $index)
    {
        $listaProduto = $this->lerArquivoJson();
        $listaProduto[$index] = $this->getInputDataProduct($request);
        $this->salvarArquivoJson($listaProduto);
        return redirect()->route('produtos.index')->with('mensagem.sucesso', 'Produto atualizado com sucesso!');
    }

    /**
     * verifica se a 'data de validade' do produto já passou, comparando com o data atual.
     *
     * @param  string  $dtValidade  Data de validade do produto no formato 'Y-m-d'.
     * @return bool  Retorna true se a data de validade já passou, caso contrário, false.
     */
    private function validarDtValidade($dtValidade)
    {
        $dtAtual = getdate();
        $dtformatada = date("Y-m-d", $dtAtual[0]);
        return $dtValidade < $dtformatada;
    }
}
