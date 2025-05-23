<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Http\Controllers\ProfilController;
use App\State\ProfilProvider;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Http\Requests\UpdateProfilRequest;

#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
    operations: [
        new Put(
            rules:UpdateProfilRequest::class,
        ),
        new Delete(),
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
        new GetCollection(
            provider: ProfilProvider::class,
            controller: ProfilController::class,
            deserialize: false,
        ),
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

    #[Groups(['read','write'])]
    public $nom;
    #[Groups(['read','write'])]
    public $prenom;
    #[Groups(['read','write'])]
    public $administrateur;
    #[Groups(['read'])]
    public $image;
    #[Groups(['write'])]
    public $statut;


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
