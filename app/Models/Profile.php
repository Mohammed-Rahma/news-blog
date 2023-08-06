<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name' , 'last_name' , 'user_id' , 'gender' , 'birthday' , 'street' , 'city', 'province' , 'postal_code'
        ,'country_code' , 'provies'
    ];
    public function user(){
       return  $this->belongsTo(User::class , 'user_id');
    }
}


