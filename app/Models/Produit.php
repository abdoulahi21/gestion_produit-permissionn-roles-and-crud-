<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom',
        'description',
        'prix',
        'quantite',
        'photo',
        'categories_id'
    ];

    public function clients()
    {
        return $this->belongsToMany(Client::class,'commandes');
    }
    public function categories()
    {
        return $this->belongsTo(Categories::class,'categories_id');
    }
}
