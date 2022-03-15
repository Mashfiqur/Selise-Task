<?php

namespace App\Models;

use App\Concerns\Models\IdHashable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;


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
    public function order() {
        return $this->belongsTo('App\Models\Order');
    }

    /**
     * Get the Product
     */
    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
    
}
