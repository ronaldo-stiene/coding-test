<?php

namespace App\Http\Services;

use App\Models\Endereco;
use App\Models\Fornecedor;

/**
 * -----------------------------------------------------------------------
 * Fornecedor Updater
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos necessários para alterar as 
 * informações dos fornecedores.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class FornecedorUpdater extends Updater
{
    /**
     * Altera as informações do fornecedor.
     *
     * @param integer $id
     * @param array $dados
     * @return Fornecedor
     */
    public function atualizarFornecedor(int $id, array $dados): Fornecedor
    {
        $fornecedor = Fornecedor::find($id);
        
        parent::atualizarCampo('nome', $fornecedor, $dados);
        parent::atualizarCampo('telefone', $fornecedor, $dados);
        $this->atualizarEndereco($fornecedor->getEndereco(), $dados);
        $fornecedor->save();

        return $fornecedor;
    }

    /**
     * Altera as informações do endereço do fornecedor.
     *
     * @param Endereco $endereco
     * @param array $dados
     * @return void
     */
    private function atualizarEndereco(Endereco $endereco, array $dados): void
    {
        parent::atualizarCampo('cep', $endereco, $dados);
        parent::atualizarCampo('rua', $endereco, $dados);
        parent::atualizarCampo('numero', $endereco, $dados);
        parent::atualizarCampo('complemento', $endereco, $dados);
        parent::atualizarCampo('cidade', $endereco, $dados);
        parent::atualizarCampo('estado', $endereco, $dados);
        $endereco->save();
    }
}
