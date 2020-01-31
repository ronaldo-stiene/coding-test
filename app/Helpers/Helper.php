<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

/**
 * -----------------------------------------------------------------------
 * Helper
 * -----------------------------------------------------------------------
 * 
 * Funções globais do projeto.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 30/01/2020
 */
class Helper extends Model
{
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
    public static function removerAcentos(string $string): string
    {
        $acentos  =  'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $sem_acentos  =  'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $string = strtr(utf8_decode($string), utf8_decode($acentos), $sem_acentos);
        $string = str_replace(" ", "", $string);
        return utf8_decode($string);
    }
}
