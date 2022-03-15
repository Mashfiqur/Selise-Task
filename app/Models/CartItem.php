<?php

namespace App\Models;

use App\Concerns\Models\IdHashable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory;

     /**
     * Provide soft delete related functionality
     */
    use SoftDeletes;


    /**
     * Provide id hashable functionality
     */
    use IdHashable;

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
        'hash_id',
    ];

    /**
     * Get the user
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the Product
     */
    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
}

