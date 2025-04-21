<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function uploadImage($request , $id)
    {
        $profil = Profil::find($id);

        $content = $request->getContent();
        $mime = $request->header('Content-Type');

        if (!in_array($mime, ['image/jpeg', 'image/png'])) {
            return response()->json(['error' => 'Unsupported media type'], 415);
        }

        $extension = $mime === 'image/png' ? 'png' : 'jpg';
        $filename = 'avatar_' . $id . '.' . $extension;

        Storage::disk('public')->put("avatars/{$filename}", $content);

        $profil->image = "avatars/{$filename}";
        $profil->save();
    
        return $profil;
    }
}
