<?php

namespace Tests\Feature;

use App\Http\Services\UserMaker;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * -----------------------------------------------------------------------
 * Testes Automatizados de Autenticação de Usuário
 * -----------------------------------------------------------------------
 * 
 * Estes testes contém as funções de autenticação de usuário.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 29/01/2020
 */
class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Usuário do teste.
     *
     * @var User
     */
    protected $user;

    /**
     * Criador de usuários.
     *
     * @var UserMaker
     */
    private $maker;

    /**
     * SetUp do teste.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Instância o Maker.
        $this->maker = new UserMaker;

        // Cria um usuário com dados do Faker.
        $this->user = $this->maker->criarUser(
            $this->faker->name,
            $this->faker->unique()->safeEmail,
            Hash::make('senha'),
            true,
        );
    }

    /**
     * Testa o login do usuário.
     *
     * @return void
     */
    public function testLogin()
    {
        // Testa o usuário.
        $this->assertInstanceOf(User::class, $this->user);
        $this->assertDatabaseHas('users', ['id' => $this->user->id]);

        // Realiza o login.
        Auth::setUser($this->user);

        // Verifica se o login foi realizado.
        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * Testa o logout do usuário.
     *
     * @return void
     */
    public function testLogout()
    {
        // Testa o usuário.
        $this->assertInstanceOf(User::class, $this->user);
        $this->assertDatabaseHas('users', ['id' => $this->user->id]);

        // Realiza o login e verifica.
        Auth::setUser($this->user);
        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($this->user);

        // Realiza o Logout.
        Auth::logout();

        // Verifica o Logout.
        $this->assertGuest();
    }
}
