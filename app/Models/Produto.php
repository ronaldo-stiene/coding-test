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

    /**
     * Gera o nome da imagem, em letras mínusculas e sem acento, a partir
     * do nome do produto.
     *
     * @param string $nome
     * @return string
     */
    public static function gerarNomeDaImagem(string $nome): string
    {
        return strtolower(self::removerAcentos($nome)) . ".jpg";
    }

    /**
     * Função que remove os acentos de uma string.
     *
     * @param string $string
     * @return string
     * 
     * @author Tiago
     * @author Ronaldo Stiene <rstiene27@gmail.com>
     * @source https://www.linhadecomando.com/php/php-funcao-para-retirar-acentos
     */
    private static function removerAcentos(string $string): string
    {
        $acentos  =  'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $sem_acentos  =  'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $string = strtr(utf8_decode($string), utf8_decode($acentos), $sem_acentos);
        $string = str_replace(" ", "", $string);
        return utf8_decode($string);
    }
}
