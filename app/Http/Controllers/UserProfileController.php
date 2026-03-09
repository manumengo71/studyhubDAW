<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileController\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function edit()
    {
        $userProfile = auth()->user()->profile; // Asumiendo que hay una relación entre User y UserProfile

        return view('profile.edit', compact('userProfile'));
    }

    public function update(UpdateRequest $request)
    {
        $request->safe();

        $userProfile = auth()->user()->profile;

        if ($request->hasFile('avatar')) {
            // Eliminar la imagen actual
            $userProfile->clearMediaCollection('users_avatar');

            // Subir la nueva imagen
            $userProfile->addMediaFromRequest('avatar')->toMediaCollection('users_avatar');
        }elseif ($request->input('avatar-remove') == 1) {
            $userProfile->clearMediaCollection('users_avatar');
        }

        $userProfile->update($request->all());

        return redirect()->route('profile.edit')->with('status', 'Perfil actualizado correctamente.');
    }

    public function getUserAvatarById($id)
    {
        $avatar = DB::table('media')->where('model_id', $id)->first();

        return $avatar;
    }
}
