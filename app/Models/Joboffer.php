<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joboffer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nameOffer',
        'status',
        'idUser',

    ];

    /**
     * Relation with users
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_offers', 'id_offer', 'id_user');
    }

}
