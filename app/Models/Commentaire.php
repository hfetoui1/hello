<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ApiResource]

class Commentaire extends Model
{
    use HasFactory;
    protected $table = 'commentaires';

    protected $fillable = ['contenu', 'administrateur_id', 'profil_id'];

    public function administrateur()
    {
        return $this->belongsTo(Administrateur::class, 'administrateur_id');
    }

    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }
}
