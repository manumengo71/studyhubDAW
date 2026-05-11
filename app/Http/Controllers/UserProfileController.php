<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileController\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    // Muestra la pagina de editar perfil
    public function edit()
    {
        $userProfile = auth()->user()->profile;

        return view('profile.edit', compact('userProfile'));
    }

    // Actualiza los datos del perfil del usuario
    public function update(UpdateRequest $request)
    {
        $request->safe();

        // Cogemos el perfil del usuario
        $userProfile = auth()->user()->profile;

        if ($request->hasFile('avatar')) {
            // Quitamos la que tenia antes
            $userProfile->clearMediaCollection('users_avatar');

            // Subimos la nueva
            $userProfile->addMediaFromRequest('avatar')->toMediaCollection('users_avatar');
        }elseif ($request->input('avatar-remove') == 1) {
            $userProfile->clearMediaCollection('users_avatar');
        }

        $userProfile->update($request->all());

        return redirect()->route('profile.edit')->with('status', 'Perfil actualizado correctamente.');
    }

    // Busca la foto de perfil de un usuario por su id
    public function getUserAvatarById($id)
    {
        $avatar = DB::table('media')->where('model_id', $id)->first();

        return $avatar;
    }
}
