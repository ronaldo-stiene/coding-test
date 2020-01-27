<?php

use App\Http\Services\ProdutoImagemSaver;
use App\Http\Services\ProdutoMaker;
use App\Models\Produto;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

/**
 * -----------------------------------------------------------------------
 * Seeder de Produtos
 * -----------------------------------------------------------------------
 * 
 * Cria os produtos que serão usados na aplicação.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class ProdutosSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dados gerados pela fábrica.
        // factory(Produto::class, 30)->create();

        // Criação dos dados manualmente.
        $this->manualSeed();
    }

    /**
     * Realiza a inserção dos dados dos produtos manualmente, onde:
     * - Os nomes são pré-definidos e organizados em categorias dentro de um array.
     * - A imagem é copiada de /storage/app/img/ para /storage/app/public/img/.
     * - A cópia das imagens irá mostrar um progresso em porcentagem no console.
     * - O nome da imagem é gerado ao transformar o nome original com letras minusculas e sem acentos.
     * - O fornecedor é definido pelo o ID do array de cada produto.
     * - A quantidade é gerada aleatóriamente.
     *
     * @return void
     */
    private function manualSeed(): void
    {
        $produtos = [
            ['Maçã Fuji', 'Banana Prata', 'Mamão Papaia', 'Morango', 'Uva Niagara Roxa', 'Uva Itália Verde', 'Abacaxi'],
            ['Repolho Verde', 'Couve Flor', 'Couve', 'Alface Americana', 'Pimentão Verde', 'Cenoura', 'Batata Inglesa', 'Batata Doce'],
            ['Picanha Bovina', 'Contra Filé', 'Alcatra', 'Linguiça Toscana', 'Filé Mignon'],
            ['Filé de Salmão', 'Bacalhau', 'Filé de Merluza', 'Tilápia'],
            ['Creme Dental Colgate', 'Sabonete Dove', 'Enxaguante Bucal Listerine', 'Condicionador Pantene', 'Shampoo Pantene', 
            'Desodorante Aerosol Men', 'Desodorante Aerosol Rexona Women'],
            ['Refrigerante Pepsi', 'Refrigerante Itubaina', 'Suco de Laranja Del Valle', 'Suco de Maracujá Maguary', 'Cerveja Eisenbahn',
            'Cerveja Heineken', 'Refrigerante Fanta', 'Cerveja Budweiser', 'Cerveja Skol', 'Cerveja Stella Artois'],
            ['Detergente Ypê', 'Sabão em pó OMO', 'Amaciante Confort Intense', 'Alvejante Brilhante', 'Desengordurante Cif', 
            'Água Sanitária Super Cândida', 'Lustra Móveis Poliflor', 'Desinfetante Veja'],
            ['Salgadinho Doritos', 'Salgadinho Ruffles', 'Bolacha Recheada Trakinas', 'Bolacha Recheada Oreo', 'Cookies Toddy',
            'Chocolate Bis Lacta', 'Caixa de Bombons Lacta', 'Bala de Gelatina Tubes Fini', 'Chocolate Nestlé Kit Kat']
        ];

        $imagensSalvas = 0;
        foreach ($produtos as $fornecedor => $tipos) {
            foreach ($tipos as $nome) {
                $nomeDaImagem = Produto::gerarNomeDaImagem($nome);
                $caminhoDaImagem = storage_path('app/img/') . $nomeDaImagem;
                $imagem = new UploadedFile($caminhoDaImagem, $nomeDaImagem);
                $imagensSalvas++;

                echo "Salvando imagens dos produtos: " . number_format( (($imagensSalvas / 58) * 100), 0 ) . "%\r";

                $maker = new ProdutoMaker();
                $maker->criarProduto(
                    $nome,
                    $imagem,
                    $fornecedor + 1,
                    rand(0, 15)
                );
            }
        }
        echo "\033[K";
    }
}
