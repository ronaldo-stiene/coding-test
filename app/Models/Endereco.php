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
     * Definição do relacionamento One To Many com o modelo Fornecedor.
     *
     * @return void
     */
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
