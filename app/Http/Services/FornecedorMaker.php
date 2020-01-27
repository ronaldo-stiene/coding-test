<?php

namespace App\Http\Services;

use App\Models\Endereco;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

/**
 * -----------------------------------------------------------------------
 * Fornecedor Maker
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos necessários para criar novos 
 * fornecedores.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class FornecedorMaker
{
    /**
     * Cria um fornecedor.
     *
     * @param string $nome
     * @param string $telefone
     * @param array $endereco
     * @return Fornecedor
     */
    public function criarFornecedor(string $nome, string $telefone, array $endereco): Fornecedor
    {
        DB::beginTransaction();
        $fornecedor = Fornecedor::create([
            'nome' => $nome,
            'telefone' => $telefone,
            'endereco_id' => $this->criarEndereco($endereco)->id
            ]);
        DB::commit();

        return $fornecedor;
    }

    /**
     * Cria o endereço do novo fornecedor.
     *
     * @param array $endereco
     * @return Endereco
     */
    private function criarEndereco(array $endereco): Endereco
    {
        $endereco = Endereco::create([
            'cep' => $endereco['cep'],
            'rua' => $endereco['rua'],
            'numero' => $endereco['numero'],
            'complemento' => $endereco['complemento'],
            'cidade' => $endereco['cidade'],
            'estado' => $endereco['estado'],
        ]);

        return $endereco;
    }
}