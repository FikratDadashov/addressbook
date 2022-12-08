<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{

    protected $fillable =[
        'name',
        'location'
    ];

    public function phones()
    {
        return Contact::hasMany(Phone::class);
    }

    public function emails()
    {
        return Contact::hasMany(Email::class);
    }

}
