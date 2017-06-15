<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['ip','user_id', 'state', 'logged_at', 'logged_out_at'];

    public $timestamps = false;

    /**
     * Обратная связь активностей пользователя.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
