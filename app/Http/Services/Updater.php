<?php

namespace App\Http\Services;

/**
 * -----------------------------------------------------------------------
 * Updater
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém uma função global que atualiza os atributos das
 * entidades.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class Updater
{
    /**
     * Recebe o nome de um atributo, podendo ser um array contendo o nome
     * da coluna, verifica se sua alteração foi solicitada e, caso tenha
     * sido, a altera
     *
     * @param $atributo
     * @param $entidade
     * @param array $dados
     * @return void
     */
    protected function atualizarCampo($atributo, $entidade, array $dados): void
    {
        if (is_array($atributo)) {
            $campo = $atributo['campo'];
            $atributo = $atributo['atributo'];
        } else {
            $campo = $atributo;
        }
        
        if (isset($dados[$campo])) {
            $entidade->$atributo = $dados[$campo];
        }
    }
}