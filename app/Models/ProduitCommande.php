<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitCommande extends Model
{
    use HasFactory;
    protected $fillable=[
        'commande_id',
        'produits_id',
        'quantite',
    ];

    public function produits()
    {
        return $this->belongsToMany(Produit::class,'produits');
    }
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

}
