<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Получаем список пользователей и последнюю активность.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        // Для каждого пользователя получаем ключ
        $users->each(function (User $user) {

            if (!cache()->has($user->getCacheKey())) {
                return;
            }

            $data = cache($user->getCacheKey());
            $user->setLastIP($data['ip']);
            $user->setLastActivity(new Carbon($data['time']));
        });

        return view('home', compact('users'));
    }
}
