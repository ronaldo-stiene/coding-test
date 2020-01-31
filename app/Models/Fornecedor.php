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
    protected $fillable = ['nome', 'telefone', 'endereco_id'];

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
     * Retorna o endereço do fornecedor.
     *
     * @return Endereco
     */
    public function getEndereco(): Endereco
    {
        return Endereco::find($this->endereco_id);
    }

    /**
     * Retorna o telefone formatado.
     *
     * @return string
     */
    public function getTelefone(): string
    {
        return preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '(${1}) ${2}-${3}', $this->telefone);
    }

    /**
     * Retorna o CEP formatado.
     *
     * @return string
     */
    public function getCep(): string
    {
        return preg_replace( '/(\d{5})(\d{3})/', '${1}-${2}', $this->getEndereco()->getCep() );
    }
    
    /**
     * Retorna o endereço formatado.
     *
     * @return string
     */
    public function getEnderecoCompleto(): string
    {
        $endereco = $this->getEndereco();
        return ucfirst($endereco->rua) . ", " .
            $endereco->numero . 
            (($endereco->complemento) ? ", " . $endereco->complemento : "" ) . " - " .
            ucfirst($endereco->cidade) . " - " .
            strtoupper($endereco->estado) . ', ' . 
            $this->getCep();
    }
}
