<?php

namespace App\Http\Services;

use App\Models\Produto;
use Illuminate\Support\Facades\Storage;

/**
 * -----------------------------------------------------------------------
 * Produto Updater
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos necessários para atualizar as 
 * informações dos produtos.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class ProdutoUpdater extends Updater
{
    /**
     * Recebe os dados e atualiza os campos.
     *
     * @param integer $id
     * @param array $dados
     * @return Produto
     */
    public function atualizarProduto(int $id, array $dados): Produto
    {
        $produto = Produto::find($id);

        parent::atualizarCampo('nome', $produto, $dados);
        $this->alterarNomeDaImagem($dados, $produto);

        $this->alterarImagem($dados, $produto);
        parent::atualizarCampo('quantidade', $produto, $dados);
        parent::atualizarCampo([
            'atributo' => 'fornecedor_id',
            'campo' => 'fornecedor'
        ], $produto, $dados);

        $produto->save();

        return $produto;
    }
    
    /**
     * Altera a imagem do produto.
     *
     * @param array $dados
     * @param Produto $produto
     * @return void
     */
    private function alterarImagem(array $dados, Produto $produto): void
    {
        if (isset($dados['imagem'])) {
            $imagem = $dados['imagem'];
            $nome = $produto->imagem;

            if ($imagem->isValid()) {
                Storage::disk('public')->delete("img/" . $nome);
                $imagem->storeAs('img', $nome, 'public');
            }
        }
    }

    /**
     * Altera o nome da imagem, caso o nome tenha sido alterado.
     *
     * @param array $dados
     * @param Produto $produto
     * @return void
     */
    private function alterarNomeDaImagem(array $dados, Produto $produto): void
    {
        if (isset($dados['nome'])) {
            $nome = Produto::gerarNomeDaImagem($dados['nome']);
            Storage::disk('public')->move("img/" . $produto->imagem, "img/" . $nome);
            $produto->imagem = $nome;
        }
    }
}