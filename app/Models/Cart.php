<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot
{
    use HasFactory , HasUuids;
   protected $table = 'carts';
    protected $fillable = [
        'cookie_id' , 'user_id' , 'product_id' , 'quantity'
    ];

    // public function uniqueIds(){
    //     return [
    //       'id' , 'cookie_id'
    //     ];
    // }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

    public function products(){
        return $this->belongsTo(Product::class);
    }



}
