<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function create($fields)
    {
        return parent::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

    }

    public function login($credentials)
    {
        $token = Auth::attempt($credentials);
        if (!$token) {
            throw new \Exception('Credencias incorretas, verifique-as e tente novamente.', -404);
        }
        return $token;
    }

    public function logout($token)
    {
        if (!Auth::invalidate($token)) {
            throw new \Exception('Erro. Tente novamente.', -404);
        }
    }

    public function tasklist()
    {
        return $this->hasMany('App\Models\TaskList');
    }
    public function tasks()
    {
        return $this->hasMany('App\Models\Tasks');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
