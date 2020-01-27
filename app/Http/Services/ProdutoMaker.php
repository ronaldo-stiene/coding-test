<?php

namespace App\Http\Services;

use App\Models\Produto;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

/**
 * -----------------------------------------------------------------------
 * Produto Maker
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos necessários para criar novos produtos.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class ProdutoMaker
{
    /**
     * Cria o produto
     *
     * @param string $nome
     * @param UploadedFile $imagem
     * @param integer $fornecedor
     * @param integer $quantidade
     * @return Produto
     */
    public function criarProduto(string $nome, UploadedFile $imagem, int $fornecedor, int $quantidade = 0): Produto
    {
        DB::beginTransaction();
        $produto = Produto::create([
            'nome' => $nome,
            'imagem' => $this->salvarImagem($imagem, $nome),
            'quantidade' => $quantidade,
            'fornecedor_id' => $fornecedor,
        ]);
        DB::commit();

        return $produto;
    }

    /**
     * Salva a imagem no diretório /storage/app/public/img.
     *
     * @param UploadedFile $imagem
     * @param string $nome
     * @return string
     */
    private function salvarImagem(UploadedFile $imagem, string $nome): string
    {
        $nome = Produto::gerarNomeDaImagem($nome);
        $imagem->storeAs('img', $nome, 'public');
        return $nome;
    }

}