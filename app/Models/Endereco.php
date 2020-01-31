<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * -----------------------------------------------------------------------
 * Endereço
 * -----------------------------------------------------------------------
 * 
 * Este modelo contém as informações de endereços dos fornecedores.
 * Eles são ligados através de chaves estrangeiras, e com o 
 * relacionamento One To One.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 25/01/2020
 */
    class Endereco extends Model
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
    protected $fillable = ['cep', 'rua', 'numero', 'cidade', 'estado'];

    /**
     * Informa o nome da tabela deste modelo.
     *
     * @var string
     */
    protected $table = 'enderecos';

    /**
     * Retorna o fornecedor que possuí este endereço.
     *
     * @return Fornecedor
     */
    public function getFornecedor(): Fornecedor
    {
        return Fornecedor::where('endereco_id', $this->id)->first();
    }

    /**
     * Retorna o CEP completo.
     *
     * @return string
     */
    public function getCep(): string
    {
        return str_pad( $this->cep, 8, 0, STR_PAD_LEFT);
    }
}
