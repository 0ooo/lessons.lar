<?php
namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Проверяем работоспособность события LogAuthenticationAttempt.
     *
     * @test
     */
    public function it_users_can_store_last_history_data()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        // Проверяем что таблица пуста
        $this->assertEquals($user->histories()->count(), 0);

        // Авторизация пользователя
        $this->attempLogin($user)
             ->assertRedirect('/home')
             ->assertStatus(302);
        $this->assertEquals($user->histories()->count(), 1);
    }

    /**
     * Вход на сайт конкретного пользователя.
     *
     * @param User $user
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function attempLogin($user)
    {
        return $this->post('/login', [
            'email'    => $user->email,
            'password' => 'secret',
        ]);
    }
}