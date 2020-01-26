<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * -----------------------------------------------------------------------
 * Produto
 * -----------------------------------------------------------------------
 * 
 * Este modelo contém as informações dos Produtos. Cada produto é ligado
 * à um fornecedor através do relacionamento One To Many.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class Produto extends Model
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
    protected $fillable = ['nome', 'imagem', 'quantidade', 'fornecedor_id'];

    /**
     * Informa o nome da tabela deste modelo.
     *
     * @var string
     */
    protected $table = 'produtos';

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
