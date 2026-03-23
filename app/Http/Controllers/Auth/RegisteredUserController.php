<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisteredUserController\StoreRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $request->safe();

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        UserProfile::create([
            'user_id' => $user->id,
        ]);

        if ($request->email == 'hola.studyhubapp.com' && $request->password == 'adminstudyhub-app' && $request->username == 'studyhub-app-admin') {
            $adminRole = Role::where('name', 'admin')->first();
            $user->assignRole($adminRole);

            // $user->email_verified_at = now(); /** Nos saltamos la verificación de correo electrónico */

            $user->profile()->update([
                'name' => 'StudyHub-App-AdminName',
                'surname' => 'AdminSurname',
                'second_surname' => 'AdminSecondSurname',
                'birthdate' => now(),
                'biological_gender' => 'Otro',
            ]);

            $user->billingInformation()->create([
                'user_id' => $user->id,
                'owner_name' => 'StudyHub-App-AdminName',
                'owner_surname' => 'AdminSurname',
                'owner_second_surname' => 'AdminSecondSurname',
                'credit_card_number' => '1234567890123456',
                'expiration_date' => '12/99',
                'cvv' => '123',
                'type_id' => 4,
            ]);

            // Crear cuenta Global de StudyHub-App

            $cuentaGlobal = User::create([
                'username' => 'studyhub-app',
                'email' => 'studyhub-app@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('1234567890'),
            ]);

            UserProfile::create([
                'user_id' => $cuentaGlobal->id,
                'name' => 'StudyHub-App',
                'surname' => 'AcademySurname',
                'second_surname' => 'AcademySecondSurname',
                'birthdate' => '2024-01-01',
                'biological_gender' => 'Masculino',
            ]);

            $cuentaGlobal->assignRole($adminRole);

            $user->save();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
