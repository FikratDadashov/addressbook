<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable =[
        'contact_id',
        'number'
    ];

    public function contact()
    {
        return Phone::belongsTo(Contact::class);
    }

}
