<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Course;
use App\Models\userProfile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
{
    return view('profile.edit', [
        'user' => $request->user(),
        'userProfile' => UserProfile::where('user_id', $request->user()->id)->first(),
    ]);
}

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Actualizar el campo 'username' en lugar de 'name'
        $user->username = $request->input('username');

        // Resto de la lógica de actualización
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Soft delete the user's account.
     */
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

    /**
     * Hard delete the user's account.
     */
    public function forceDelete(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Obtener todos los cursos del usuario
        $courses = Course::where('owner_id', $user->id)->get();

        // Obtener id del usuario StudyHub-App
        $academy = User::where('username', 'StudyHub-App')->first();

        // Modificar el owner_id de cada curso
        foreach ($courses as $course) {
            $course->owner_id = $academy->id; // Modificar el owner_id según sea necesario
            $course->save(); // Guardar el curso con el nuevo owner_id
        }

        $user->forceDelete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}
