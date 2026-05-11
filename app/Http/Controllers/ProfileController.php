<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Course;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ProfileController extends Controller
{
    // Muestra la pagina de editar perfil
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'userProfile' => UserProfile::where('user_id', $request->user()->id)->first(),
        ]);
    }

    // Actualiza los datos del perfil (username y email)
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Actualizamos el username
        $user->username = $request->input('username');

        // Si ha cambiado el email, quitamos la verificacion para que la repita
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // Desactiva la cuenta del usuario (borrado logico, se puede recuperar)
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // Elimina la cuenta de forma permanente. Los cursos pasan a la cuenta global
    public function forceDelete(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Cogemos todos los cursos que tenia
        $courses = Course::withTrashed()->where('owner_id', $user->id)->get();

        // Buscamos la cuenta global de la app
        $academy = User::where('username', 'studyhub-app')->first();

        // Pasamos sus cursos a la cuenta global para que no se pierdan
        foreach ($courses as $course) {
            $course->owner_id = $academy->id;
            $course->save();
        }

        $user->forceDelete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
