<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * -----------------------------------------------------------------------
 * Fornecedor
 * -----------------------------------------------------------------------
 * 
 * Este modelo contém as informações do fornecedor. O seu endereço é 
 * ligado com o modelo Endereços, com o relacionamento One To One.
 * Todo Fornecedor possuí produtos, ligados com o relacionamento
 * One To Many.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class Fornecedor extends Model
{
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
    protected $fillable = ['nome', 'telefone'];

    /**
     * Informa o nome da tabela deste modelo.
     *
     * @var string
     */
    protected $table = 'fornecedores';

    /**
     * Definição do relacionamento One To Many com o modelo Produto.
     *
     * @return void
     */
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    /**
     * Definição do relacionamento One To One com o modelo Endereço.
     *
     * @return void
     */
    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }
}
