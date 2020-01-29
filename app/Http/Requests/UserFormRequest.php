<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * -----------------------------------------------------------------------
 * Request dos formulários de Usuário
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos de validação das informações passadas
 * pelos formulários dos relacioandos a usuário.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 29/01/2020
 */
class UserFormRequest extends FormRequest
{
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'user';

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
            'name' => 'string|regex:/^[A-Za-z0-1À-ú -]+$/|min:3',
            'email' => 'string|email',
            'password' => 'string|min:5',
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
            'boolean' => 'O campo :attribute precsa ser do tipo booleano.',
            'regex' => 'O campo :attribute possuí caracteres não permitidos.',
            'email' => 'O e-mail fornecido não é válido.',
            'name.min' => 'O campo :attribute precisa ter pelo menos :min caracteres.',
            'password.min' => 'A senha precisa ter pelo menos :min caracteres.',
        ];
    }
}
