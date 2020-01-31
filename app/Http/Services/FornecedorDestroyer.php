<?php

namespace App\Http\Services;

use App\Models\Endereco;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

/**
 * -----------------------------------------------------------------------
 * Fornecedor Destroyer
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos necessários para excluir fornecedores.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class FornecedorDestroyer
{
    /**
     * Excluí o fornecedor.
     *
     * @param integer $id
     * @return string
     */
    public function removerFornecedor(int $id): string
    {
        $nome = '';
        DB::transaction(function () use ($id, &$nome) {
            $fornecedor = Fornecedor::find($id);
            $this->verificarProdutos($fornecedor);
            $nome = $fornecedor->nome;
            $endereco = $fornecedor->getEndereco();
            $fornecedor->delete();
            $this->removerEndereco($endereco->id);
        });
        return $nome;
    }

    /**
     * Excluí o endereço do fornecedor.
     *
     * @param integer $id
     * @return void
     */
    private function removerEndereco(int $id): void
    {
        DB::transaction(function () use ($id) {
            $endereco = Endereco::find($id);
            $endereco->delete();
        });
    }

    /**
     * Verifica se o fornecedor tem produtos cadastrados.
     *
     * @param Fornecedor $fornecedor
     * @return void
     */
    private function verificarProdutos(Fornecedor $fornecedor): void
    {
        if ($fornecedor->produtos->count() > 0) {
            throw new \Exception("Existe produtos comprados por esse fornecedor. Remova-os ou altere seus fornecedores antes de realizar a exclusão.", 1);
        }
    }
}
