<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ApiResource]
class Profil extends Model
{

    use HasFactory;

    protected $table = 'profils';

    protected $fillable = [
        'nom',
        'prenom',
        'administrateur_id',
        'image',
        'statut',
    ];

    public function administrateur()
    {
        return \App\Models\Administrateur::find($this->administrateur_id);
    }

    protected $hidden = ['commentaires'];

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}
