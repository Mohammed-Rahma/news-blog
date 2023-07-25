<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;
use Whoops\Exception\Formatter;

class Product extends Model
{
    use HasFactory;

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
    public function getPriceFormmatedAttribute()
    {
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price, 'ILS');
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
