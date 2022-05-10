<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_offer extends Model
{
    use HasFactory;

    protected $table = 'user_offers';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_offer',
    ];

}
