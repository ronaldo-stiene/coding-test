<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Produto;
use App\Models\Fornecedor;
use Illuminate\Http\UploadedFile;
use App\Http\Services\ProdutoMaker;
use App\Http\Services\ProdutoUpdater;
use App\Http\Services\ProdutoDestroyer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * -----------------------------------------------------------------------
 * Testes Automatizados de CRUD do Produto
 * -----------------------------------------------------------------------
 * 
 * Estes testes contém as funções Create, Read, Update e Delete dos
 * produtos e suas imagens.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 27/01/2020
 */
class ProdutoCrudTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Fornecedor usado no teste.
     *
     * @var Fornecedor
     */
    private $fornecedor;

    /**
     * Produto usado no teste.
     *
     * @var Produto
     */
    private $produto;

    /**
     * Imagem usado no teste.
     *
     * @var UploadedFile
     */
    private $imagem;

    /**
     * Criador de produtos.
     *
     * @var ProdutoMaker
     */
    private $maker;

    /**
     * Atualizador de dados do produto.
     *
     * @var ProdutoUpdater
     */
    private $updater;

    /**
     * Removedor de produtos.
     *
     * @var ProdutoDestroyer
     */
    private $destroyer;

    /**
     * SetUp do teste.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Instância os helpers.
        $this->maker = new ProdutoMaker;
        $this->updater = new ProdutoUpdater;
        $this->destroyer = new ProdutoDestroyer;

        // Cria um fornecedor através de sua factory.
        $this->fornecedor = factory(Fornecedor::class, 1)->create()[0];

        // Cria uma imagem de teste.
        $this->imagem = UploadedFile::fake()->image('teste.jpg');

        // Cria o produto com dados do Faker.
        $this->produto = $this->maker->criarProduto(
            'Produto ' . $this->faker->randomNumber(6),
            $this->imagem,
            $this->fornecedor->id,
            $this->faker->numberBetween(0, 15),
        );
    }

    /**
     * Cria um novo fornecedor.
     *
     * @return Fornecedor
     */
    protected function getNewFornecedor(): Fornecedor
    {
        return factory(Fornecedor::class, 1)->create()[0];
    }

    /**
     * Obtém dados de um produto através de sua factory.
     *
     * @return Produto
     */
    protected function getProduto(): Produto
    {
        return factory(Produto::class, 1)->make()[0];
    }

    /**
     * Deleta a imagém criada de teste. Esta imagem foi criada na pasta
     * /storage/app/public/img/ para testar o processo de criação com 
     * o ProdutoMaker. Após cada teste, esse método deve ser usado para 
     * excluir a imagem criada.
     *
     * @param string $nomeImagem
     * @return void
     */
    private function deletarImagemTeste(string $nomeImagem): void
    {
        Storage::disk('public')->delete("img/" . $nomeImagem);
    }

    /**
     * Testa a criação de produtos através da sua factory.
     *
     * @return void
     */
    public function testFactoryProduto()
    {
        // Cria o fornecedor e dois produtos.
        $fornecedor = factory(Fornecedor::class, 1)->create()[0];
        $produtos = factory(Produto::class, 2)->create([
            'fornecedor_id' => $fornecedor->id
        ]);

        // Verifica a criação realizada acima.
        $this->assertInstanceOf(Fornecedor::class, $fornecedor);
        $this->assertDatabaseHas('fornecedores', ['id' => $fornecedor->id]);

        // Verifica a existência de cada produto e a validade dos seus dados.
        foreach ($produtos as $produto) {
            $this->assertInstanceOf(Produto::class, $produto);
            $this->assertDatabaseHas('produtos', ['id' => $produto->id]);
            $this->assertDatabaseHas('fornecedores', ['id' => $produto->fornecedor_id]);
            $this->assertDatabaseHas('fornecedores', ['id' => $produto->fornecedor->id]);

            $this->assertIsString($produto->nome);
            $this->assertIsString($produto->imagem);
            $this->assertIsNumeric($produto->quantidade);
            $this->assertIsNumeric($produto->fornecedor_id);
        }

        // Excluí a imagem de teste criada.
        $this->deletarImagemTeste($this->produto->imagem);
    }

    /**
     * Testa a criação de produtos.
     *
     * @return void
     */
    public function testCriarProduto()
    {
        // Verifica a criação do fornecedor.
        $this->assertInstanceOf(Fornecedor::class, $this->fornecedor);
        $this->assertDatabaseHas('fornecedores', ['id' => $this->fornecedor->id]);

        // Verifica a criação do produto e o seu relacionamento com o seu fornecedor.
        $this->assertInstanceOf(Produto::class, $this->produto);
        $this->assertDatabaseHas('produtos', ['id' => $this->produto->id]);
        $this->assertDatabaseHas('fornecedores', ['id' => $this->produto->fornecedor_id]);
        $this->assertDatabaseHas('fornecedores', ['id' => $this->produto->fornecedor->id]);

        // Verifica os dados do produto.
        $this->assertIsString($this->produto->nome);
        $this->assertIsString($this->produto->imagem);
        $this->assertIsNumeric($this->produto->quantidade);
        $this->assertIsNumeric($this->produto->fornecedor_id);

        // Excluí a imagem de teste criada.
        $this->deletarImagemTeste($this->produto->imagem);
    }

    /**
     * Testa a criação da imagem do produto
     *
     * @return void
     */
    public function testSalvarImagem()
    {
        // Verifica a imagem criada.
        $this->assertInstanceOf(UploadedFile::class, $this->imagem);

        // Verifica se a imagem foi criada na pasta correta.
        Storage::disk('public')->assertExists('img/' . $this->produto->imagem);

        // Excluí a imagem de teste criada.
        $this->deletarImagemTeste($this->produto->imagem);
    }

    /**
     * Testa a obtenção de dados de um produto.
     *
     * @return void
     */
    public function testListarProduto()
    {
        // Obtém e verifica um produto.
        $produto = Produto::find($this->produto->id);
        $this->assertInstanceOf(Produto::class, $produto);

        // Verifica os dados do produto obtido.
        $this->assertEquals($this->produto->nome, $produto->nome);
        $this->assertEquals($this->produto->imagem, $produto->imagem);
        $this->assertEquals($this->produto->quantidade, $produto->quantidade);
        $this->assertEquals($this->produto->fornecedor_id, $produto->fornecedor_id);
        $this->assertEquals($this->produto->fornecedor->id, $this->fornecedor->id);
        
        // Excluí a imagem de teste criada.
        $this->deletarImagemTeste($this->produto->imagem);
    }

    /**
     * Testa a alteração de daddos de um produto.
     *
     * @return void
     */
    public function testAlterarProduto()
    {
        // Obtém os dados de um novo produto e o verifica.
        $novoProduto = $this->getProduto();
        $this->assertInstanceOf(Produto::class, $novoProduto);

        // Cria um novo fornecedor e o verifica.
        $novoFornecedor = $this->getNewFornecedor();
        $this->assertInstanceOf(Fornecedor::class, $novoFornecedor);

        // Atualiza os dados verifica o produto atualizado.
        $produtoAtualizado = $this->updater->atualizarProduto(
            $this->produto->id,
            [
                'nome' => $novoProduto->nome,
                'quantidade' => $novoProduto->quantidade,
                'fornecedor' => $novoFornecedor->id
            ]
        );
        $this->assertInstanceOf(Produto::class, $produtoAtualizado);

        // Verifica os dados do produto atualizado.
        $this->assertEquals($produtoAtualizado->nome, $novoProduto->nome);
        $this->assertEquals($produtoAtualizado->imagem, Produto::gerarNomeDaImagem($novoProduto->nome));
        $this->assertEquals($produtoAtualizado->quantidade, $novoProduto->quantidade);
        $this->assertEquals($produtoAtualizado->fornecedor_id, $novoFornecedor->id);

        // Verifica se o nome da imagem foi alterado.
        Storage::disk('public')->assertExists('img/' . $produtoAtualizado->imagem);
        Storage::disk('public')->assertMissing('img/' . $this->produto->imagem);

        // Excluí a imagem de teste criada.
        $this->deletarImagemTeste($produtoAtualizado->imagem);
    }

    /**
     * Testa a alteração da imagem de um produto.
     *
     * @return void
     */
    public function testAlterarImagem()
    {
        // Obtém uma nova imagem e a verifica.
        $novaImagem = UploadedFile::fake()->image('teste2.jpg');
        $this->assertInstanceOf(UploadedFile::class, $novaImagem);

        // Atualiza a imagem e verifica o produto atualizado.
        $produtoAtualizado = $this->updater->atualizarProduto(
            $this->produto->id,
            [
                'imagem' => $novaImagem,
            ]
        );
        $this->assertInstanceOf(Produto::class, $produtoAtualizado);

        // Verifica o nome da imagem atualizada.
        $this->assertEquals($produtoAtualizado->imagem, $this->produto->imagem);

        // Verifica a imagem.
        Storage::disk('public')->assertExists('img/' . $produtoAtualizado->imagem);

        // Excluí a imagem de teste criada.
        $this->deletarImagemTeste($produtoAtualizado->imagem);
    }

    /**
     * Testa a exclusão de um produto
     *
     * @return void
     */
    public function testExcluirProduto()
    {
        // Verifica a existência do produto e da sua imagem.
        $this->assertDatabaseHas('produtos', ['id' => $this->produto->id]);
        Storage::disk('public')->assertExists('img/' . $this->produto->imagem);

        // Excluí o produto e verifica o retorno obtido.
        $nomeDoProduto = $this->destroyer->removerProduto($this->produto->id);
        $this->assertIsString($nomeDoProduto);
        $this->assertEquals($nomeDoProduto, $this->produto->nome);

        // Verifica se o produto e a imagem foram excluídas.
        $this->assertDatabaseMissing('produtos', ['id' => $this->produto->id]);
        Storage::disk('public')->assertMissing('img/' . $this->produto->imagem);

        // Excluí a imagem de teste criada, caso não tenha sido.
        $this->deletarImagemTeste($this->produto->imagem);
    }
}
