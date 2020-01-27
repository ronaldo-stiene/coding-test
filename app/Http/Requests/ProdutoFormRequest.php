<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * -----------------------------------------------------------------------
 * Request dos formulários de Produtos
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos de validação das informações passadas
 * pelos formulários dos produtos.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class ProdutoFormRequest extends FormRequest
{
    /**
     * Determina se o usuário é autorizado para fazer está requisição.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtém as regras de validação para está requisição.
     *
     * @return array
     */
    public function rules()
    {
        // @todo TIRAR O REQUIRED, PARA COLOCAR APENAS NA VIEW
        return [
            'nome' => 'string|regex:/^[A-Za-z0-1 -]+$/|min:3',
            'imagem' => 'file|image|max:2048',
            'quantidade' => 'numeric|min:0',
            'fornecedor' => 'integer|numeric|exists:fornecedores,id',
        ];
    }

    /**
     * Obtém as mensagens de erros para as regras de validação definidas.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'string' => 'O campo :attribute precsa ser do tipo string.',
            'integer' => 'O campo :attribute precsa ser do tipo inteiro.',
            'numeric' => 'O campo :attribute deve ter apenas números.',
            'nome.min' => 'O campo :attribute precisa ter pelo menos :min caracteres.',
            'quantidade.min' => 'O campo :attribute precisa ter uma quantidade de no minímo :min.',
            'regex' => 'O campo :attribute possuí caracteres não permitidos.',
            'exists' => 'O campo :attribute não possuí um valor na coluna :column da tabela :table.',
            'file' => 'O campo :attribute não possuí um arquivo válido.',
            'image' => 'O campo :attribute não possuí uma imagem válida.',
            'imagem.max' => 'O campo :attribute deve ter até :max kb.',
        ];
    }
}
