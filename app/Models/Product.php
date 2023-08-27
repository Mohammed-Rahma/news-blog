<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function getPriceFormattedAttribute()
    {
        // 'en' = config('app.local') يقرا الللغة حسب لغة الابلكيشن 
        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price, 'USD');
    }
    public function getComparePriceFormattedAttribute()
    {
        // 'en' = config('app.local') يقرا الللغة حسب لغة الابلكيشن 
        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->compare_price, 'USD');
    }
  
    // api
    protected $appends = [
        'image_url',
        'price_formatted',
        'ComparePriceFormatted'
    ];

    protected $hidden = [
        'updated_at', 'deleted_at', 'image'
    ];
    // end api


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'name' => 'Category NOt found ',
            // 'image'=>''
        ]);
    }

    public function gallery()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart(){
        $this->belongsToMany(User::class , 'carts'  , 'product_id' ,'user_id')
             ->withPivot(['quantity'])
             ->withTimestamps()
             ->using(Cart::class);
    }




    public static function  StatusOptions()
    {
        return [
            self::Status_Active => 'active',
            self::Status_Draft => 'draft',
            self::Status_Archived => 'archived'

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

    public function scopeFilter(Builder $query , $request)
    {
        $query->when($request->search, function ($query, $value) {
            $query->where('products.name', 'Like', "%$value%")
                ->orWhere('products.description', 'Like', "%$value%");
        })
            ->when($request->category_id, function ($query, $value) {
                $query->where('categories.id', 'Like', "%$value%");
            })
            ->when($request->status, function ($query, $value) {
                $query->where('products.status', 'Like', "%$value%");
            })
            ->when($request->price_min, function ($query, $value) {
                $query->where('products.price', '>=', $value);
            })
            ->when($request->price_max, function ($query, $value) {
                $query->where('products.price', '<=', $value);
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
