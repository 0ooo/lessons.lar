<?php

namespace App;

use App\Models\History;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Последний ip пользователя.
     *
     * @var string
     */
    protected $lastIP = null;

    /**
     * Последняя активность пользователя.
     *
     * @var Carbon
     */
    protected $lastActivity = null;

    /**
     * Получение ключа для записи в cache.
     *
     * @return string
     */
    public function getCacheKey () {
        if (! $this->exists) {
            throw new ModelNotFoundException();
        }

        return $this->getTable() . '#' . $this->id;
    }

    /**
     * Получение данных о активности пользователя.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories()
    {
        return $this->hasMany(History::class);
    }

    /**
     * Получение последнего IP.
     *
     * @return string
     */
    public function getLastIP()
    {
        return $this->lastIP;
    }

    /**
     * Установить последний IP.
     *
     * @param string $lastIP
     */
    public function setLastIP($lastIP)
    {
        $this->lastIP = $lastIP;
    }

    /**
     * Получение времени последней активности.
     *
     * @return string
     */
    public function getLastActivity()
    {
        return $this->lastActivity ? $this->lastActivity->diffForHumans() : null;
    }

    /**
     * Установка времени последней активности.
     *
     * @param Carbon $lastActivity
     */
    public function setLastActivity($lastActivity)
    {
        $this->lastActivity = $lastActivity;
    }
}
