<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminController\EditCategoryRequest;
use App\Http\Requests\AdminController\EditRoleRequest;
use App\Http\Requests\AdminController\StoreCategoryRequest;
use App\Http\Requests\AdminController\StoreCourseRequest;
use App\Http\Requests\AdminController\StoreRoleRequest;
use App\Http\Requests\AdminController\StoreUserRequest;
use App\Http\Requests\AdminController\UpdateUserRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CustomRole;
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

    public function searchRole(Request $request)
    {
        // Barra de búsqueda
        $keywords = $request->input('search');

        // Filtros
        $name = $request->input('nombre');
        $guardName = $request->input('guard_name');
        $status = $request->input('status');
        $orden = $request->input('orden');

        // inputs
        $input = $request->all();

        // Crear query de roles con todos los roles existentes en la base de datos (incluso los eliminados) para poder filtrarlos correctamente en la vista listado-roles
        $query = Role::query();

        // Aplicar filtros
        if ($name) {
            $query->where('name', 'LIKE', "%$name%");
        }

        if ($guardName) {
            $query->where('guard_name', 'LIKE', "%$guardName%");
        }

        if ($status === 'todos') {
            $query->whereNotNull('deleted_at')->orWhereNull('deleted_at');
        }else if ($status === 'activo') {
            $query->whereNull('deleted_at');
        }else if ($status === 'inactivo') {
            $query->whereNotNull('deleted_at');
        }

        // Aplicar búsqueda global
        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->where('name', 'LIKE', "%$keywords%")
                ->orWhere('guard_name', 'LIKE', "%$keywords%");
            });
        }

        if ($orden) {
            if ($orden === 'asc' || $orden === 'desc') {
                // Si se ha seleccionado algún filtro específico
                if ($name && !$guardName) {
                    $query->orderBy($name, $orden);
                } elseif (!$name && $guardName) {
                    $query->orderBy('guard_name', $orden);
                } elseif ($name && $guardName) {
                    $query->orderBy($name, $orden)
                          ->orderBy('guard_name', $orden);
                } else {
                    // Si no se ha seleccionado ningún filtro específico
                    $query->orderBy('name', $orden)
                          ->orderBy('guard_name', $orden);
                }
            }
        }

        $roles = $query->get();


        return view('admin.listado-roles', compact('roles', 'input'));
    }

    public function searchCategories(Request $request)
    {
        // Barra de búsqueda
        $keywords = $request->input('search');

        // Filtros
        $name = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $status = $request->input('status');
        $orden = $request->input('orden');

        // inputs
        $input = $request->all();

        // Crear query de categorias con todos los categorias existentes en la base de datos (incluso las eliminadas) para poder filtrarlas correctamente en la vista listado-categorias
        $query = CourseCategory::query();

        // Aplicar filtros
        if ($name) {
            $query->where('name', 'LIKE', "%$name%");
        }

        if ($descripcion) {
            $query->where('description', 'LIKE', "%$descripcion%");
        }

        if ($status === 'todos') {
            $query->whereNotNull('deleted_at')->orWhereNull('deleted_at');
        }else if ($status === 'activo') {
            $query->whereNull('deleted_at');
        }else if ($status === 'inactivo') {
            $query->whereNotNull('deleted_at');
        }

        // Aplicar búsqueda global
        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->where('name', 'LIKE', "%$keywords%")
                ->orWhere('description', 'LIKE', "%$keywords%");
            });
        }

        if ($orden) {
            if ($orden === 'asc' || $orden === 'desc') {
                // Si se ha seleccionado algún filtro específico
                if ($name && !$descripcion) {
                    $query->orderBy($name, $orden);
                } elseif (!$name && $descripcion) {
                    $query->orderBy('description', $orden);
                } elseif ($name && $descripcion) {
                    $query->orderBy($name, $orden)
                          ->orderBy('description', $orden);
                } else {
                    // Si no se ha seleccionado ningún filtro específico
                    $query->orderBy('name', $orden)
                          ->orderBy('description', $orden);
                }
            }
        }

        $categories = $query->paginate(5);

        return view('admin.listado-categorias', compact('categories', 'input'));
    }

    public function searchCourses(Request $request)
    {
        // Barra de búsqueda
        $keywords = $request->input('search');

        // Filtros
        $name = $request->input('nombre');
        $breve_descripcion = $request->input('breve_descripcion');
        $descripcion = $request->input('descripcion');
        $language = $request->input('language');
        $status = $request->input('status');
        $orden = $request->input('orden');

        // inputs
        $input = $request->all();

        // Crear query de cursos con todos los cursos existentes en la base de datos (incluso los eliminados) para poder filtrarlos correctamente en la vista listado-cursos
        $query = Course::query();

        // Aplicar filtros
        if ($name) {
            $query->where('name', 'LIKE', "%$name%");
        }

        if ($breve_descripcion) {
            $query->where('short_description', 'LIKE', "%$breve_descripcion%");
        }

        if ($descripcion) {
            $query->where('description', 'LIKE', "%$descripcion%");
        }

        if ($language) {
            $query->where('language', 'LIKE', "%$language%");
        }

        if ($status === 'todos') {
            $query->whereNotNull('deleted_at')->orWhereNull('deleted_at');
        }else if ($status === 'activo') {
            $query->whereNull('deleted_at');
        }else if ($status === 'inactivo') {
            $query->whereNotNull('deleted_at');
        }

        // Aplicar búsqueda global
        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->where('name', 'LIKE', "%$keywords%")
                ->orWhere('description', 'LIKE', "%$keywords%");
            });
        }

        if ($orden) {
            if ($orden === 'asc' || $orden === 'desc') {
                // Si se ha seleccionado algún filtro específico
                if ($name && !$descripcion) {
                    $query->orderBy($name, $orden);
                } elseif (!$name && $descripcion) {
                    $query->orderBy('description', $orden);
                } elseif ($name && $descripcion) {
                    $query->orderBy($name, $orden)
                          ->orderBy('description', $orden);
                } else {
                    // Si no se ha seleccionado ningún filtro específico
                    $query->orderBy('name', $orden)
                          ->orderBy('description', $orden);
                }
            }
        }

        $courses = $query->paginate(5);
        $languages = Course::select('language')->distinct()->pluck('language');

        return view('admin.listado-cursos', compact('courses', 'input', 'languages'));
    }




    public function searchUsers(Request $request)
    {
        // Barra de búsqueda
        $keywords = $request->input('search');

        // Filtros
        $username = $request->input('username');
        $email = $request->input('email');
        $name = $request->input('nombre');
        $apellido1 = $request->input('apellido1');
        $apellido2 = $request->input('apellido2');
        $fecha_nacimiento = $request->input('fecha_nacimiento');
        $genero = $request->input('biological_gender');
        $role = $request->input('role');
        $status = $request->input('status');
        $orden = $request->input('orden');

        // inputs
        $input = $request->all();

        // Crear query de usuarios con todos los usuarios existentes en la base de datos (incluso los eliminados) para poder filtrarlos correctamente en la vista listado-usuarios
        $userQuery = User::query();

        // Crear query de perfiles de usuario con todos los perfiles existentes en la base de datos (incluso los eliminados) para poder filtrarlos correctamente en la vista listado-usuarios
        $profileQuery = UserProfile::query();

        // Aplicar filtros
        if ($username) {
            $userQuery->where('username', 'LIKE', "%$username%");
        }

        if ($email) {
            $userQuery->where('email', 'LIKE', "%$email%");
        }

        if ($name) {
            $profileQuery->where('name', 'LIKE', "%$name%");
        }

        if ($apellido1) {
            $profileQuery->where('surname', 'LIKE', "%$apellido1%");
        }

        if ($apellido2) {
            $profileQuery->where('second_surname', 'LIKE', "%$apellido2%");
        }

        if ($fecha_nacimiento) {
            $profileQuery->where('birthdate', 'LIKE', "%$fecha_nacimiento%");
        }

        if ($genero) {
            $profileQuery->where('biological_gender', 'LIKE', "%$genero%");
        }

        if ($role) {
            $userQuery->whereHas('roles', function ($q) use ($role) {
                $q->where('id', 'LIKE', "%$role%");
            });
        }

        if ($status === 'todos') {
            $userQuery->whereNotNull('deleted_at')->orWhereNull('deleted_at');
        }else if ($status === 'activo') {
            $userQuery->whereNull('deleted_at');
        }else if ($status === 'inactivo') {
            $userQuery->whereNotNull('deleted_at');
        }

        // Aplicar búsqueda global
        if ($keywords) {
            $userQuery->where(function ($q) use ($keywords) {
                $q->where('name', 'LIKE', "%$keywords%")
                ->orWhere('description', 'LIKE', "%$keywords%");
            });
        }

        if ($keywords) {
            $profileQuery->where(function ($q) use ($keywords) {
                $q->where('name', 'LIKE', "%$keywords%")
                ->orWhere('description', 'LIKE', "%$keywords%");
            });
        }

        // if ($orden) {
        //     if ($orden === 'asc' || $orden === 'desc') {
        //         // Si se ha seleccionado algún filtro específico
        //         if ($name && !$descripcion) {
        //             $query->orderBy($name, $orden);
        //         } elseif (!$name && $descripcion) {
        //             $query->orderBy('description', $orden);
        //         } elseif ($name && $descripcion) {
        //             $query->orderBy($name, $orden)
        //                   ->orderBy('description', $orden);
        //         } else {
        //             // Si no se ha seleccionado ningún filtro específico
        //             $query->orderBy('name', $orden)
        //                   ->orderBy('description', $orden);
        //         }
        //     }
        // }

        // $users =
        $roles = Role::whereHas('users')->get();

        return view('admin.listado-usuario', compact('users', 'input', 'roles' ));
    }

    public function listUsers()
    {
        $roles = Role::whereHas('users')->get();
        $users = User::withTrashed()->paginate(5);
        $input = [];
        return view('admin.listado-usuario', compact('users', 'roles', 'input'));
    }

    public function listCourses()
    {

        $languages = Course::select('language')->distinct()->pluck('language');
        $courses = Course::withTrashed()->paginate(5);
        $input = [];
        return view('admin.listado-cursos', compact('courses', 'languages', 'input'));
    }

    public function listCategories()
    {
        $categories = CourseCategory::withTrashed()->paginate(5);
        $input = [];
        return view('admin.listado-categorias', compact('categories', 'input'));
    }

    public function listRoles()
    {
        $roles = Role::all();
        $input = [];
        return view('admin.listado-roles', compact('roles', 'input'));
    }

    public function storeCourse(StoreCourseRequest $request)
    {
        $request->safe();

        $curso = Course::create([
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'language' => $request->input('language'),
            'owner_id' => $request->input('owner_id'),
            'courses_categories_id' => $request->input('courses_categories_id'),
        ]);

        // SoftDelete del curso para que no aparezca en la lista de cursos (Se puede activar después)
        $curso->delete();


        // Si recibe una imagen, se guarda.
        if ($request->hasFile('imageCourse')) {
            $curso->addMediaFromRequest('imageCourse')->toMediaCollection('courses_images');
        } else {
            $curso->addMediaFromUrl('https://i.postimg.cc/HkL86Lc1/sinfoto.png')->toMediaCollection('courses_images');
        }

        return redirect()->route('listCourses');
    }

    public function createCourse(): View
    {
        $users = User::withTrashed()->get();
        $categories = CourseCategory::all();
        return view('admin.createCourse', compact('users', 'categories'));
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

        if ($request->hasFile('imageCategory')) {
            $category->addMediaFromRequest('imageCategory')->toMediaCollection('images_categories');
        }

        $category->delete();

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

    public function storeUser(StoreUserRequest $request)
    {
        $request->safe();

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

    /**
     * Desactivar una categoría
     *
     */
    public function destroyCategory(CourseCategory $category)
    {
        $category->delete();

        return redirect()->route('listCategories')->with('success', 'Categoría eliminada correctamente');
    }

    /**
     * Activar una categoría
     *
     */
    public function activateCategory(Request $category)
    {
        $category = CourseCategory::withTrashed()->find($category->category);

        $category->restore();

        return redirect()->route('listCategories')->with('success', 'Categoría activada correctamente');
    }

    /**
     * Eliminar una categoría
     *
     */
    public function forceDestroyCategory(Request $category)
    {
        $category = CourseCategory::withTrashed()->find($category->id);

        $category->forceDelete();

        return redirect()->route('listCategories')->with('success', 'Categoría eliminada permanentemente');
    }

    /**
     * Vista para editar una categoría
     *
     */
    public function editCategoryView(Request $category): View
    {
        $category = CourseCategory::withTrashed()->find($category->category);

        return view('admin.editCategory', compact('category'));
    }

    /**
     * Editar una categoría
     *
     */
    public function editCategory(EditCategoryRequest $request)
    {
        $request->safe();

        $category = CourseCategory::withTrashed()->find($request->id);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('listCategories')->with('success', 'Categoría editada correctamente');
    }

    /**
     * Vista para editar un role
     *
     */
    public function editRoleView(Request $request): View
    {
        $id = $request->id;

        $role = CustomRole::withTrashed()->where('id', $id)->first();

        return view('admin.editRole', compact('role'));
    }

    /**
     * Editar un role
     *
     */
    public function editRole(EditRoleRequest $request)
    {
        $request->safe();

        $id = $request->id;

        $role = CustomRole::withTrashed()->where('id', $id)->first();

        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->route('listRoles')->with('success', 'Rol editado correctamente');
    }

    /**
     * Activar un role
     *
     */
    public function activateRole(Request $request)
    {
        $id = $request->id;

        $role = CustomRole::withTrashed()->where('id', $id)->first();

        $role->restore();

        return redirect()->route('listRoles')->with('success', 'Rol activado correctamente');
    }

    /**
     * Desactivar un role
     *
     */
    public function destroyRole(Request $request)
    {
        $id = $request->id;

        $role = CustomRole::withTrashed()->where('id', $id)->first();

        $role->delete();

        return redirect()->route('listRoles')->with('success', 'Rol desactivado correctamente');
    }

    /**
     * Eliminar un role
     *
     */
    public function forceDestroyRole(Request $request)
    {
        $id = $request->id;
        $guardName = $request->guard_name;

        // si el guard no existe no deja borrarlo, como hago para crear roles con guard_name diferente a web?
        $role = CustomRole::withTrashed()->where('id', $id)->where('guard_name', $guardName)->first();

        $role->forceDelete();

        return redirect()->route('listRoles')->with('success', 'Rol eliminado permanentemente');
    }
    public function editUser($id)
    {
        $user = User::withTrashed($id)->first();
        // $user = User::findOrFail($id);
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

    public function activateUser(Request $request)
    {
        $user = User::withTrashed()->find($request->id);
        $user->restore();

        return redirect()->route('listUsers');
    }

    public function disableUser(User $user)
    {
        $user->delete();

        return redirect()->route('listUsers');
    }

    public function deleteUser(User $user)
    {
        // Obtener todos los cursos del usuario
        $courses = Course::where('owner_id', $user->id)->get();

        // Obtener id del usuario StudyHub-App
        $academy = User::where('username', 'StudyHub-App')->first();

        // Modificar el owner_id de cada curso
        foreach ($courses as $course) {
            $course->owner_id = $academy->id; // Modificar el owner_id según sea necesario
            $course->save(); // Guardar el curso con el nuevo owner_id
        }

        // Eliminar al usuario
        $user->forceDelete();

        return redirect()->route('listUsers');
    }

    public function activateCourse(Request $request)
    {
        $course = Course::withTrashed()->find($request->id);
        $course->restore();

        return redirect()->route('listCourses');
    }

    public function disableCourse(Course $course)
    {
        $course->delete();

        return redirect()->route('listCourses');
    }

    public function deleteCourse(Course $course)
    {
        $course->forceDelete();

        return redirect()->route('listCourses');
    }
}
