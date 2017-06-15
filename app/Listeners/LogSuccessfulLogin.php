<?php

namespace App\Listeners;

use App\Models\History;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogin
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
     * Записуем информацию о входе пользователя в аккаунт.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $history = new History();

        $history->ip = Request::ip();;
        $history->state = 'logged in';
        $history->user_id = auth()->id();
        $history->logged_at = Carbon::now();

        $history->save();

    }
}
