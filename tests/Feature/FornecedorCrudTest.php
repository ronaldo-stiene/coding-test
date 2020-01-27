<?php

namespace Tests\Feature;

use App\Http\Services\FornecedorDestroyer;
use App\Http\Services\FornecedorMaker;
use App\Http\Services\FornecedorUpdater;
use Tests\TestCase;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Produto;
use Exception;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Provider\pt_BR\Company as BrCompany;
use Faker\Provider\pt_BR\PhoneNumber as BrPhoneNumber;
use Faker\Provider\pt_BR\Address as BrAddress;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * -----------------------------------------------------------------------
 * Testes Automatizados de CRUD do Fornecedor
 * -----------------------------------------------------------------------
 * 
 * Estes testes contém as funções Create, Read, Update e Delete dos
 * fornecedores e endereços.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 27/01/2020
 */
class FornecedorCrudTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Fornecedor do teste.
     *
     * @var Fornecedor
     */
    private $fornecedor;

    /**
     * Endereço do teste
     *
     * @var Endereco
     */
    private $endereco;

    /**
     * Criador de fornecedores.
     *
     * @var FornecedorMaker
     */
    private $maker;

    /**
     * Atualizador de dados do fornecedor.
     *
     * @var FornecedorUpdater
     */
    private $updater;

    /**
     * Removedor de fornecedores.
     *
     * @var FornecedorDestroyer
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

        // Adiciona os providers do faker.
        $this->faker->addProvider(new BrCompany($this->faker));
        $this->faker->addProvider(new BrPhoneNumber($this->faker));
        $this->faker->addProvider(new BrAddress($this->faker));

        // Instância os helpers.
        $this->maker = new FornecedorMaker;
        $this->updater = new FornecedorUpdater;
        $this->destroyer= new FornecedorDestroyer;

        // Cria um fornecedor com dados do Faker.
        $this->fornecedor = $this->maker->criarFornecedor(
            $this->faker->company,
            $this->faker->phoneNumberCleared,
            [
                'cep' => $this->faker->randomNumber(8),
                'rua' => $this->faker->streetName,
                'numero' => $this->faker->buildingNumber,
                'complemento' => $this->faker->secondaryAddress,
                'cidade' => $this->faker->city,
                'estado' => $this->faker->stateAbbr,
            ]
        );

        // Obtém o endereço do fornecedor criado.
        $this->endereco = Endereco::find($this->fornecedor->endereco_id);
    }

    /**
     * Obtém dados de um fornecedor através de sua fábrica.
     *
     * @return Fornecedor
     */
    protected function getFornecedor(): Fornecedor
    {
        return factory(Fornecedor::class, 1)->make()[0];
    }

    /**
     * Obtém dados de um endereço através de sua fábrica.
     *
     * @return Endereco
     */
    protected function getEndereco(): Endereco
    {
        return factory(Endereco::class, 1)->make()[0];
    }

    /**
     * Cria produtos para o fornecedor do teste.
     *
     * @return Collection
     */
    protected function criarProdutos(): Collection
    {
        return factory(Produto::class, 3)->create([
            'fornecedor_id' => $this->fornecedor->id
        ]);
    }

    /**
     * Testa a criação do fornecedor através da sua factory.
     *
     * @return void
     */
    public function testFactoryFornecedor()
    {
        // Cria o fornecedor
        $fornecedor = factory(Fornecedor::class, 1)->create()[0];

        // Verifica o fornecedor criado.
        $this->assertInstanceOf(Fornecedor::class, $fornecedor);
        $this->assertDatabaseHas('fornecedores', ['id' => $fornecedor->id]);

        // Verifica o dados do fornecedor criado.
        $this->assertIsString($fornecedor->nome);
        $this->assertIsNumeric($fornecedor->telefone);
        $this->assertIsNumeric($fornecedor->endereco_id);
    }

    /**
     * Testa a criação de um endereço através da sua factory.
     *
     * @return void
     */
    public function testFactoryEndereco()
    {
        // Cria o fornecedor e obtém o seu endereço.
        $fornecedor = factory(Fornecedor::class, 1)->create()[0];
        $endereco = Endereco::find($fornecedor->endereco_id);

        // Verifica o endereço criado.
        $this->assertInstanceOf(Endereco::class, $fornecedor->getEndereco());
        $this->assertDatabaseHas('enderecos', ['id' => $fornecedor->endereco_id]);
        $this->assertEquals($endereco->id, $fornecedor->getEndereco()->id);
        $this->assertEquals($endereco->getFornecedor()->id, $fornecedor->id);

        // Verifica os dados do endereço criado.
        $this->assertIsNumeric($endereco->cep);
        $this->assertIsString($endereco->rua);
        $this->assertIsString($endereco->numero);
        $this->assertIsString($endereco->cidade);
        $this->assertIsString($endereco->estado);
    }

    /**
     * Teste de criação de fornecedor.
     *
     * @return void
     */
    public function testCriarFornecedor()
    {
        // Verifica o fornecedor criado.
        $this->assertInstanceOf(Fornecedor::class, $this->fornecedor);
        $this->assertDatabaseHas('fornecedores', ['id' => $this->fornecedor->id]);

        // Verifica o dados do fornecedor criado.
        $this->assertIsString($this->fornecedor->nome);
        $this->assertIsNumeric($this->fornecedor->telefone);
        $this->assertIsNumeric($this->fornecedor->endereco_id);
    }

    /**
     * Teste de criação de endereço.
     *
     * @return void
     */
    public function testCriarEndereco()
    {
        // Verifica o endereço criado.
        $this->assertInstanceOf(Endereco::class, $this->fornecedor->getEndereco());
        $this->assertDatabaseHas('enderecos', ['id' => $this->fornecedor->endereco_id]);
        $this->assertEquals($this->endereco->id, $this->fornecedor->getEndereco()->id);
        $this->assertEquals($this->endereco->getFornecedor()->id, $this->fornecedor->id);

        // Verifica os dados do endereço criado.
        $this->assertIsNumeric($this->endereco->cep);
        $this->assertIsString($this->endereco->rua);
        $this->assertIsString($this->endereco->numero);
        $this->assertIsString($this->endereco->cidade);
        $this->assertIsString($this->endereco->estado);
    }

    /**
     * Teste a obtenção de dados de um fornecedor.
     *
     * @return void
     */
    public function testListarFornecedor()
    {
        // Obtém e verifica um fornecedor.
        $fornecedor = Fornecedor::find($this->fornecedor->id);
        $this->assertInstanceOf(Fornecedor::class, $fornecedor);

        // Verifica os dados de um fornecedor.
        $this->assertEquals($this->fornecedor->nome, $fornecedor->nome);
        $this->assertEquals($this->fornecedor->telefone, $fornecedor->telefone);
        $this->assertEquals($this->fornecedor->getEndereco(), $fornecedor->getEndereco());
    }

    /**
     * Teste de obtenção do endereço de um fornecedor.
     *
     * @return void
     */
    public function testListarEndereco()
    {
        // Obtém e verifica um endereço.
        $endereco = Endereco::find($this->endereco->id);
        $this->assertInstanceOf(Endereco::class, $endereco);

        // Obtém e verifica os dados de um endereço.
        $this->assertEquals($this->endereco->cep, $endereco->cep);
        $this->assertEquals($this->endereco->rua, $endereco->rua);
        $this->assertEquals($this->endereco->numero, $endereco->numero);
        $this->assertEquals($this->endereco->complemento, $endereco->complemento);
        $this->assertEquals($this->endereco->cidade, $endereco->cidade);
        $this->assertEquals($this->endereco->estado, $endereco->estado);
        $this->assertEquals($this->endereco->getFornecedor(), $endereco->getFornecedor());
    }

    /**
     * Testa a alteração de dados de um fornecedor.
     *
     * @return void
     */
    public function testAlterarFornecedor()
    {
        // Obtém novos dados de fornecedor e os verifica.
        $novoFornecedor = $this->getFornecedor();
        $this->assertInstanceOf(Fornecedor::class, $novoFornecedor);

        // Atualiza os dados e verifica o fornecedor atualizado.
        $fornecedorAtualizado = $this->updater->atualizarFornecedor($this->fornecedor->id, [
            'nome' => $novoFornecedor->nome,
            'telefone' => $novoFornecedor->telefone,
        ]);
        $this->assertInstanceOf(Fornecedor::class, $fornecedorAtualizado);

        // Verifica os dados do fornecedor atualizado.
        $this->assertEquals($fornecedorAtualizado->nome, $novoFornecedor->nome);
        $this->assertEquals($fornecedorAtualizado->telefone, $novoFornecedor->telefone);
    }

    /**
     * Testa a alteração de dados do endereço de um fornecedor.
     *
     * @return void
     */
    public function testAlterarEndereco()
    {
        // Obtém novos dados de endereço e os verifica.
        $novoEndereco = $this->getEndereco();
        $this->assertInstanceOf(Endereco::class, $novoEndereco);

        // Atualiza os dados e verifica o fornecedor com endereços atualizados.
        $fornecedorAtualizado = $this->updater->atualizarFornecedor($this->fornecedor->id, [
            'cep' => $novoEndereco->cep,
            'rua' => $novoEndereco->rua,
            'numero' => $novoEndereco->numero,
            'complemento' => $novoEndereco->complemento,
            'cidade' => $novoEndereco->cidade,
            'estado' => $novoEndereco->estado,
        ]);
        $enderecoAtualizado = $fornecedorAtualizado->getEndereco();
        $this->assertInstanceOf(Endereco::class, $enderecoAtualizado);

        // Verifica os dados do endereço atualizado.
        $this->assertEquals($enderecoAtualizado->cep, $novoEndereco->cep);
        $this->assertEquals($enderecoAtualizado->rua, $novoEndereco->rua);
        $this->assertEquals($enderecoAtualizado->numero, $novoEndereco->numero);
        $this->assertEquals($enderecoAtualizado->complemento, $novoEndereco->complemento);
        $this->assertEquals($enderecoAtualizado->cidade, $novoEndereco->cidade);
        $this->assertEquals($enderecoAtualizado->estado, $novoEndereco->estado);
    }

    /**
     * Testa a exclusão de um fornecedor, junto com seu endereço.
     *
     * @return void
     */
    public function testExcluirFornecedor()
    {
        // Verifica a existência do fornecedor e do endereço.
        $this->assertDatabaseHas('fornecedores', ['id' => $this->fornecedor->id]);  
        $this->assertDatabaseHas('enderecos', ['id' => $this->fornecedor->endereco_id]);

        // Excluí o fornecedor e verifica o retorno.
        $nomeDoFornecedor = $this->destroyer->removerFornecedor($this->fornecedor->id);
        $this->assertIsString($nomeDoFornecedor);
        $this->assertEquals($nomeDoFornecedor, $this->fornecedor->nome);

        // Verifica se o fornecedor e o endereço foram excluídos.
        $this->assertDatabaseMissing('fornecedores', ['id' => $this->fornecedor->id]);
        $this->assertDatabaseMissing('enderecos', ['id' => $this->fornecedor->endereco_id]);
    }

    /**
     * Testa a exclusão de um fornecedor que contenha produtos.
     */
    public function testExcluirFornecedorComProdutos()
    {
        // Verifica a existência do fornecedor e do endereço.
        $this->assertDatabaseHas('fornecedores', ['id' => $this->fornecedor->id]);
        $this->assertDatabaseHas('enderecos', ['id' => $this->fornecedor->endereco_id]);

        // Cria alguns produtos e os verifica.
        $produtos = $this->criarProdutos();
        foreach ($produtos as $produto) {
            $this->assertInstanceOf(Produto::class, $produto);
        }

        // Afirma que é esperado uma exceção.
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Existe produtos comprados por esse fornecedor');
        
        // Tenta excluir o fornecedor.
        $this->destroyer->removerFornecedor($this->fornecedor->id);
    }
}
