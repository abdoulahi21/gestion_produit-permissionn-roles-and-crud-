<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelProduitCommande extends Model
{
    use HasFactory;
    protected $fillable=[
        'commande_id',
        'produits_id',
        'quantite',
    ];
}
