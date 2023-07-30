<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;
use Whoops\Exception\Formatter;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    const  Status_Active = 'active';
    const  Status_Draft = 'draft';
    const Status_Archived = 'archived';
    protected $fillable = [
        'name', 'slug', 'category_id', 'description', 'short_description', 'price', 'compare_price', 'image', 'status'
    ];


    public static function  StatusOptions()
    {
        return [
            self::Status_Active => 'active',
            self::Status_Draft => 'draft',
            self::Status_Archived => 'Archived'

        ];
    }
    
    //Global scope 
    public static function booted(){
       static::addGlobalScope('owner' , function($query){
             $query->where('user_id' , '=' , 1);
       });
    }

    //local scope
    public function scopeActive($query){
        $query->where('status' , '=' , 'active');
    }


    public function getPriceFormmatedAttribute()
    {
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price, 'ILS');
    }
    public function getComparePriceFormmatedAttribute()
    {
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->compare_price, 'USD');
    }
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getImageURLAttribute()
    {
        if ($this->image) {
            return asset('storage/'. $this->image);
        }
        return 'https://placehold.co/600x600';
    }

}
