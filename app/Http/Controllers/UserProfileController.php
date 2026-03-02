<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function edit()
    {
        $userProfile = auth()->user()->profile; // Asumiendo que hay una relación entre User y UserProfile

        return view('profile.edit', compact('userProfile'));
    }

    public function update(Request $request)
    {
        $userProfile = auth()->user()->profile;

        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'second_surname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'biological_gender' => 'required|string|max:255',
        ]);

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
