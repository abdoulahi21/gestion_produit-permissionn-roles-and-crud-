<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable=[
        'clients_id',
        'produits_id',
        'quantite',
        'date',
    ];
    public function produits()
    {
        return $this->belongsToMany(Produit::class,'commandes');
    }
    public function clients()
    {
        return $this->belongsToMany(Client::class,'clients');
    }
}
