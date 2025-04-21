<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Http\Requests\StoreCommentaireRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ApiResource(
    operations: [
        new Post(
            rules:StoreCommentaireRequest::class,
        ),
    ])
]

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
