<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use NumberFormatter;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const  Status_Active = 'active';
    const  Status_Draft = 'draft';
    const Status_Archived = 'archived';
    protected $fillable = [
        'name', 'slug', 'user_id', 'category_id', 'description', 'short_description', 'price', 'compare_price', 'image', 'status'
    ];

    // public function getPriceFormmatedAttribute()
    // {
    //     $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
    //     return $formatter->formatCurrency($this->price, 'ILS');
    // }
    // public function getComparePriceFormmatedAttribute()
    // {
    //     $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
    //     return $formatter->formatCurrency($this->compare_price, 'USD');
    // }



    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'name' => 'Category NOt found ',
            // 'image'=>''
        ]);
    }


    public static function  StatusOptions()
    {
        return [
            self::Status_Active => 'active',
            self::Status_Draft => 'draft',
            self::Status_Archived => 'Archived'

        ];
    }

    //Global scope 
    public static function booted()
    {
        static::addGlobalScope('owner', function ($query) {
            $query->where('user_id', '=', Auth::id());
        });
    }

    //local scope
    public function scopeActive($query)
    {
        $query->where('status', '=', 'active');
    }

    public function scopeFilter($query, $array)
    {
     $query->when($array['search'] ?? false , function ($query, $value) {
            $query->where(function ($query) use ($value) {
                $query->where('products.name', 'Like', "%$value%")
                    ->orWhere('description', 'Like', "%$value%");
                });
             })
            ->when($array['status'] ?? false, function ($query, $value) {
                $query->where('status', '=', $value);
            })
            ->when($array['category_id'] ?? false, function ($query, $value) {
                $query->where('category_id', '=', $value);
            })
            ->when($array['price_min'] ?? false, function ($query, $value) {
                $query->where('price', '>=', $value);
            })
            ->when($array['price_max'] ?? false , function ($query, $value) {
                $query->where('price', '<=', $value);
            });
    }



    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getImageURLAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return 'https://placehold.co/600x600';
    }
}
