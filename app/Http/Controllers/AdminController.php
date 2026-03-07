<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminController\StoreCategoryRequest;
use App\Http\Requests\AdminController\StoreRoleRequest;
use App\Http\Requests\AdminController\UpdateUserRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use App\Models\userProfile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function listUsers()
    {
        $users = User::withTrashed()->paginate(5);

        return view('admin.listado-usuario', compact('users'));
    }

    public function listCourses()
    {
        $courses = Course::withTrashed()->paginate(5);
        return view('admin.listado-cursos', compact('courses'));
    }

    public function listCategories()
    {
        $categories = CourseCategory::withTrashed()->paginate(5);
        return view('admin.listado-categorias', compact('categories'));
    }

    public function listRoles()
    {
        $roles = Role::all();
        return view('admin.roles', compact('roles'));
    }

    public function createCategory(): View
    {
        return view('admin.createCategory');
    }

    public function storeCategory(StoreCategoryRequest $request)
    {
        $request->safe();

        // Se valida los datos en el request.

        // Se crea la categoría
        $category = CourseCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        // Se devuelve a listCategories con mensaje de éxito.
        return redirect()->route('listCategories')->with('success', 'Categoría creada correctamente');
    }

    public function createRole(): View
    {
        return view('admin.createRole');
    }

    public function storeRole(StoreRoleRequest $request)
    {
        $request->safe();

        // Se valida los datos en el request.

        // Se crea el rol
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => $request->input('guard_name'),
        ]);

        // Devolver a listRoles con mensaje de éxito.
        return redirect()->route('listRoles')->with('success', 'Rol creado correctamente');
    }

    public function createUser(): View
    {
        $roles = Role::all();

        return view('admin.new-user', compact('roles'));
    }

    public function storeUser(Request $request)
    {
        // dd($request);
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'second_surname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'gender' => 'required|string',
            'role' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $userProfile = UserProfile::create([
            'user_id' => $user->id,
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'second_surname' => $request->input('second_surname'),
            'birthdate' => $request->input('birthdate'),
            'biological_gender' => $request->input('gender'),
        ]);

        $userProfile = UserProfile::where('user_id', $user->id)->first();

        // Subir la nueva imagen
        if ($request->hasFile('avatar')) {
            $userProfile->addMediaFromRequest('avatar')->toMediaCollection('users_avatar');
        }

        $user->assignRole($request->input('role'));

        return redirect()->route('listUsers')->with('success', 'Usuario creado correctamente');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $userProfile = UserProfile::where('user_id', $user->id)->first();
        $roles = Role::all();

        return view('admin.editUser', compact('user', 'roles', 'userProfile'));
    }

    public function updateUser(UpdateUserRequest $request): RedirectResponse
{
    $request->safe();

    $user = User::findOrFail($request->id);
    $user->update([
        'username' => $request->input('username'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
    ]);

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    $userProfile = $user->profile;
    $userProfile->update([
        'name' => $request->input('name'),
        'surname' => $request->input('surname'),
        'second_surname' => $request->input('second_surname'),
        'birthdate' => $request->input('birthdate'),
        'biological_gender' => $request->input('gender')
    ]);

    $userProfile->save();

    // Verificar si 'role' está presente en los datos validados
    $role = $request->validated()['role'] ?? null;

    if ($role) {
        // Actualizar el rol del usuario
        $user->syncRoles([$role]);
    }

    // Subir la nueva imagen
    if ($request->hasFile('avatar')) {
        // Eliminar la imagen actual
        $userProfile->clearMediaCollection('users_avatar');
        // Subir la nueva imagen
        $userProfile->addMediaFromRequest('avatar')->toMediaCollection('users_avatar');
    } elseif ($request->input('avatar-remove') == 1) {
        $userProfile->clearMediaCollection('users_avatar');
    }

    return Redirect::route('listUsers')->with('success', 'Usuario actualizado correctamente');
}

}
