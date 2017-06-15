<?php

namespace App\Listeners;

use App\Models\History;
use Illuminate\Auth\Events\Attempting;
use App\User;
use Illuminate\Support\Facades\Request;

class LogAuthenticationAttempt
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Проверка на повторную авторизацию при не закрытой сессии.
     *
     * @param  Attempting  $event
     * @return void
     */
    public function handle(Attempting $event)
    {
        $currentIp = Request::ip(); // Текущий IP пользователя
        $currentEmail = $event->credentials['email'];

        $user = User::where('email', $currentEmail)->first();

        $authExists = History::where('logged_out_at',null)
                             ->where('user_id', $user->id)
                             ->where('ip', '!=', $currentIp)
                             ->exists();

        if($authExists) abort(403);
    }
}
