<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * -----------------------------------------------------------------------
 * Request dos formulários de Estoque
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos de validação das informações passadas
 * pelos formulários relacionados ao estoque.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class EstoqueFormRequest extends FormRequest
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
        return [
            'compra' => 'integer|numeric|min:0',
            'venda' => 'integer|numeric|min:0',
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
            'integer' => 'O campo :attribute precsa ser do tipo inteiro.',
            'numeric' => 'O campo :attribute deve ter apenas números.',
            'compra.min' => 'O campo :attribute precisa ter uma quantidade de no minímo :min.',
            'venda.min' => 'O campo :attribute precisa ter uma quantidade de no minímo :min.',
        ];
    }
}
