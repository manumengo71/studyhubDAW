<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $userProfile->update($request->all());

        return redirect()->route('profile.edit')->with('status', 'Perfil actualizado correctamente.');
    }
}
