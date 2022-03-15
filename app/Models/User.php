<?php

namespace App\Models;

use App\Concerns\Models\IdHashable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /**
     * Provide id hashable functionality
     */
    use IdHashable;

    /**
     * Provide soft delete related functionality
     */
    use SoftDeletes;

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'hash_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the cart items of the this user/employee
     */
    public function cart_items() {
        return $this->hasMany('App\Models\CartItem', 'user_id');
    }

    /**
     * Get the cart items of the this user/employee
     */
    public function orders() {
        return $this->hasMany('App\Models\Order', 'user_id');
    }
}
