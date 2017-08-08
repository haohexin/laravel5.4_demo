<?php

namespace App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admin extends Authenticatable
{
    use EntrustUserTrait;
    protected $table = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function roles() {
        return $this->belongsToMany ( 'App\Model\Role', 'role_user', 'user_id', 'role_id' );
    }
}
