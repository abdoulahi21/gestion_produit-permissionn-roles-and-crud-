<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Paginate(int $int)
 */
class Client extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom',
        'prenom',
        'adresse',
        'numeroTelephone',
        'sexe',
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
