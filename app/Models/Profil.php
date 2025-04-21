<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Http\Controllers\ProfilController;
use App\State\ProfilProvider;

#[ApiResource(
    operations: [
        new Get(),
        new Put(),
        new Delete(),
        new Post(),
        new Post(
            denormalizationContext: ['groups' => ['setimage']],
            uriTemplate:'/profils/{id}/image',
            controller: ProfilController::class,
            inputFormats: [
                'image/jpeg' => ['image/jpeg'],
                'image/png' => ['image/png'],
            ],
            provider: ProfilProvider::class,
            deserialize: false,
            write: false
        ),
        new GetCollection(),
    ]
)]
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
