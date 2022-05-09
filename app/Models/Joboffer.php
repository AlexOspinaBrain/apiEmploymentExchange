<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joboffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nameOffer',
        'status',
        'idUser',

    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_offers', 'id_offer', 'id_user');
    }

}
