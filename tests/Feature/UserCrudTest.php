<?php

namespace Tests\Feature;

use App\Http\Services\UserDestroyer;
use App\Http\Services\UserMaker;
use App\Http\Services\UserUpdater;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

/**
 * -----------------------------------------------------------------------
 * Testes Automatizados de CRUD do Usuário
 * -----------------------------------------------------------------------
 * 
 * Estes testes contém as funções Create, Read, Update e Delete dos
 * produtos e suas imagens. Herda de UserTest.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 29/01/2020
 */
class UserCrudTest extends UserTest
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Criador de usuários.
     *
     * @var UserMaker
     */
    private $maker;

    /**
     * Atualizador de dados do usuários.
     *
     * @var UserUpdater
     */
    private $updater;

    /**
     * Removedor de usuários.
     *
     * @var UserDestroyer
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
        $this->maker = new UserMaker;
        $this->updater = new UserUpdater;
        $this->destroyer = new UserDestroyer;
    }

    /**
     * Obtém dados de um usuário através de sua fábrica.
     *
     * @return User
     */
    protected function getUser(): User
    {
        return factory(User::class, 1)->make()[0];
    }

    /**
     * Testa a criação do usuário através da sua factory.
     *
     * @return void
     */
    public function testFactoryUser()
    {
        // Cria o usuário
        $user = factory(User::class, 1)->create()[0];

        // Verifica o usuário criado.
        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', ['id' => $user->id]);

        // Verifica o dados do usuário criado.
        $this->assertIsString($user->name);
        $this->assertIsString($user->email);
        $this->assertIsString($user->password);
        $this->assertIsBool($user->admin);
    }

    /**
     * Teste de criação de usuário.
     *
     * @return void
     */
    public function testCriarUser()
    {
        // Verifica o usuário criado.
        $this->assertInstanceOf(User::class, $this->user);
        $this->assertDatabaseHas('users', ['id' => $this->user->id]);

        // Verifica o dados do usuário criado.
        $this->assertIsString($this->user->name);
        $this->assertIsString($this->user->email);
        $this->assertIsString($this->user->password);
        $this->assertIsBool($this->user->admin);
    }

    /**
     * Teste a obtenção de dados de um usuário.
     *
     * @return void
     */
    public function testListarUser()
    {
        // Obtém e verifica um usuário.
        $user = User::find($this->user->id);
        $this->assertInstanceOf(User::class, $user);

        // Verifica os dados de um usuário.
        $this->assertEquals($this->user->name, $user->name);
        $this->assertEquals($this->user->email, $user->email);
        $this->assertEquals($this->user->password, $user->password);
        $this->assertEquals($this->user->admin, $user->admin);
    }

    /**
     * Testa a alteração de dados de um usuário.
     *
     * @return void
     */
    public function testAlterarUser()
    {
        // Obtém novos dados de usuário e os verifica.
        $novoUser = $this->getUser();
        $this->assertInstanceOf(User::class, $novoUser);

        // Atualiza os dados e verifica o usuário atualizado.
        $userAtualizado = $this->updater->atualizarUser($this->user->id, [
            'name' => $novoUser->name,
            'email' => $novoUser->email,
            'admin' => $novoUser->admin,
        ]);
        $this->assertInstanceOf(User::class, $userAtualizado);

        // Verifica os dados do usuário atualizado.
        $this->assertEquals($userAtualizado->name, $novoUser->name);
        $this->assertEquals($userAtualizado->email, $novoUser->email);
        $this->assertEquals($userAtualizado->admin, $novoUser->admin);
    }

    /**
     * Testa a alteração de senha.
     *
     * @return void
     */
    public function testAlterarSenha()
    {
        $novaSenha = 'novasenha';
        $this->user->alterarSenha($novaSenha, $novaSenha);

        $this->assertTrue(Hash::check($novaSenha, $this->user->password));
    }

    /**
     * Testa a redefinição de senha.
     *
     * @return void
     */
    public function testRedefinirSenha()
    {
        $novaSenha = 'novasenha';
        $this->user->redefinirSenha($novaSenha);

        $this->assertTrue(Hash::check($novaSenha, $this->user->password));
    }

    /**
     * Testa a exclusão de um usuários, junto com seu endereço.
     *
     * @return void
     */
    public function testExcluirUser()
    {
        // Verifica a existência do usuários e do endereço.
        $this->assertDatabaseHas('users', ['id' => $this->user->id]);

        // Excluí o usuário e verifica o retorno.
        $nomeDoUser = $this->destroyer->removerUser($this->user->id);
        $this->assertIsString($nomeDoUser);
        $this->assertEquals($nomeDoUser, $this->user->name);

        // Verifica se o usuário e o endereço foram excluídos.
        $this->assertDatabaseMissing('users', ['id' => $this->user->id]);
    }
}
