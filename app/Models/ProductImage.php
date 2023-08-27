<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'image'
    ];
    protected $appends = [
        'GalleryImage' 
    ];

    protected $hidden =[
        'image' , 'created_at' , 'updated_at'
    ];


    public function getGalleryImageAttribute(){
        return asset('storage/'. $this->image);
    }
}
