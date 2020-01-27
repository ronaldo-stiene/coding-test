<?php

namespace App\Http\Services;

use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * -----------------------------------------------------------------------
 * Produto Destroyer
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos necessários para excluir um produto.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class ProdutoDestroyer
{
    /**
     * Excluí o produto.
     *
     * @param integer $id
     * @return string
     */
    public function removerProduto(int $id): string
    {
        $nome = '';
        DB::transaction(function () use ($id, &$nome) {
            $produto = Produto::find($id);
            $nome = $produto->nome;
            $this->removerImagem($produto->imagem);
            $produto->delete();
        });
        return $nome;
    }

    /**
     * Remove a imagem do produto.
     *
     * @param string $nome
     * @return void
     */
    private function removerImagem(string $nome)
    {
        Storage::disk('public')->delete("img/" . $nome);
    }
}