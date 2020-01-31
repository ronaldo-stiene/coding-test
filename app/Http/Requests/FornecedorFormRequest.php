<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * -----------------------------------------------------------------------
 * Request dos formulários de Fornecedores
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos de validação das informações passadas
 * pelos formulários dos fornecedores e endereços.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class FornecedorFormRequest extends FormRequest
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
            'nome' => 'required|string|regex:/^[A-Za-z0-1À-ú -]+$/|min:3|max:50',
            'telefone' => 'required|numeric|digits_between:10,11',
            'cep' => 'required|numeric|digits:8',
            'rua' => 'required|string|min:3|max:50',
            'numero' => 'required|string|alpha_num|max:6',
            'complemento' => 'string|nullable|max:20',
            'cidade' => 'required|string|regex:/^[A-Za-z0-1À-ú -]+$/|min:3|max:50',
            'estado' => 'required|string|alpha|size:2',
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
            'required' => 'O campo :attribute é necessário.',
            'string' => 'O campo :attribute precsa ser do tipo string.',
            'integer' => 'O campo :attribute precsa ser do tipo inteiro.',
            'alpha' => 'O campo :attribute deve ter apenas letras.',
            'alpha_num' => 'O campo :attribute deve ter apenas letras e números.',
            'alpha_dash' => 'O campo :attribute deve ter apenas letras, números e traços.',
            'numeric' => 'O campo :attribute deve ter apenas números.',
            'min' => 'O campo :attribute precisa ter pelo menos :min caracteres.',
            'max' => 'O campo :attribute deve ter até :max caracteres.',
            'size' => 'O campo :attribute deve ter :size caracteres.',
            'digits' => 'O campo :attribute deve ter :digits dígitos.',
            'digits_between' => 'O campo :attribute deve ter entre :min e :max dígitos.',
            'regex' => 'O campo :attribute possuí caracteres não permitidos.',
        ];
    }
}
