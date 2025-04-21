<?php
namespace App\State;

use ApiPlatform\State\ProviderInterface;
use App\Http\Controllers\ProfilController;
use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilProvider implements ProviderInterface
{
    public function provide(\ApiPlatform\Metadata\Operation $operation, array $uriVariables = [], array $context = []): ?Profil
    {
        $id = $uriVariables['id'] ?? null;
        /** @var Request|null $request */
        $request = $context['request'] ?? null;
        if (!$request instanceof Request) {
            // fallback: get current Laravel request (not guaranteed in all contexts)
            $request = request();
        }

        $controller = new ProfilController();

        return $controller->uploadImage($request,$id);
    }
}
