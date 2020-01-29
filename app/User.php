<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * -----------------------------------------------------------------------
 * Usuário
 * -----------------------------------------------------------------------
 * 
 * Este modelo contém as informações dos usuários da aplicação.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 29/01/2020
 */
class User extends Authenticatable
{

    use Notifiable;

    /**
     * Indica se o modelo terá a columa timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Informa os campos que podem ser preenchidos do modelo.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin'
    ];

    /**
     * Os atributos que devem ser ocultos aos arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha', 'remember_token',
    ];

    /**
     * Altera a senha do usuário.
     *
     * @param string $senha
     * @param string $confirmacao
     * @return void
     */
    public function alterarSenha(string $senha, string $confirmacao): void
    {
        if ($senha !== $confirmacao) {
            throw new \Exception("As senhas não correspondem", 1);
        }
        $this->password = Hash::make($senha);
        $this->save();
    }

    /**
     * Redefine a senha do usuário.
     *
     * @param string $senha
     * @return void
     */
    public function redefinirSenha(string $senha): void
    {
        $this->password = Hash::make($senha);
        $this->save();
    }
}
