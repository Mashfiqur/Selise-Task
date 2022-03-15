<?php

namespace App\Models;

use App\Concerns\Models\IdHashable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
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
}
