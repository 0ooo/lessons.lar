<?php

namespace App\Listeners;

use App\Models\History;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogout
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
     * Меняем значение полей в базе при выходе.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        History::where('user_id', auth()->id())->update([
            'state' => 'logged out',
            'logged_out_at' => Carbon::now()
        ]);
    }
}
