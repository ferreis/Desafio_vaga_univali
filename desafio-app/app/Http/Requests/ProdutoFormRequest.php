<?php

namespace App\Http\Requests;

use App\UnidadeMedida;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Classe ProdutoFormRequest
 *
 * Esta classe é usada para validar os dados de entrada de um formulário de produto que extende o formRquest que tambem extende Request.
 */
class ProdutoFormRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta solicitação.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtém as regras de validação que se aplicam à solicitação.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome_Name' => ['required', 'string', 'max:50'],
            'unidadeMedida_Name' => [Rule::enum(UnidadeMedida::class)],
            'quantidade_Name' => [
                'required',
            ],
            'preco_Name' => ['required'],
            'dtValidade_Name' => ['required_if_accepted:perecivel_Name'],
            'dtFabricacao_Name' => [
                'required', function ($attribute, $value, $fail) {
                    $validade = strtotime($this->input('dtValidade_Name'));
                    $fabricacao = strtotime($value);
                    if ($fabricacao > $validade && $validade != null) {
                        $fail('A data de fabricação deve ser anterior à data de validade.');
                    }
                },
            ],
        ];
    }

    /**
     * Obtém as mensagens de erro personalizadas para a validação.
     *
     * @return array<string, string>
     */
    public
    function messages()
    {
        return [
            'nome_Name.required' => "O campo 'Nome do item' é obrigatório.",
            'nome_Name.string' => "O campo 'Nome do item' deve ser texto.",
            'nome_Name.max' => "O campo 'Nome do item' deve ter no maximo 50 caracteres.",
            'quantidade_Name.required' => "O campo 'Quantidade' é obrigatório.",
            'dtFabricacao_Name.required' => "O campo 'Data de fabricação' é obrigatório.",
            'dtValidade_Name.required_if_accepted' => "O campo 'Data de validade' é obrigatório quando o produto é perecível.",
            'preco_Name' => "O campo de 'Preço' é obrigatório."
        ];
    }
}
