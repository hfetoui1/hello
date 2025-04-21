<?php
namespace App\State;

use ApiPlatform\State\ProviderInterface;
use App\Http\Controllers\ProfilController;
use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilProvider implements ProviderInterface
{
    public function provide(\ApiPlatform\Metadata\Operation $operation, array $uriVariables = [], array $context = []): Profil|array|null
    {
        $id = $uriVariables['id'] ?? null;
        /** @var Request|null $request */
        $request = $context['request'] ?? null;
        if (!$request instanceof Request) {
            // fallback: get current Laravel request (not guaranteed in all contexts)
            $request = request();
        }

        $controller = new ProfilController();


        /** @var \ApiPlatform\Metadata\HttpOperation  $operation */
        $method = $operation->getMethod();
        if($method == 'POST'){
            return $controller->uploadImage($request,$id);
        }else{
            return $controller->getProfils($request,$id)->toArray();
        }
        
    }
}
