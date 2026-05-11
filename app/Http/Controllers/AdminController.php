<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminController\EditCategoryRequest;
use App\Http\Requests\AdminController\EditRoleRequest;
use App\Http\Requests\AdminController\StoreCategoryRequest;
use App\Http\Requests\AdminController\StoreCourseRequest;
use App\Http\Requests\AdminController\StoreLessonRequestStep1;
use App\Http\Requests\AdminController\StoreLessonRequestStep2;
use App\Http\Requests\AdminController\StoreRoleRequest;
use App\Http\Requests\AdminController\StoreUserRequest;
use App\Http\Requests\AdminController\UpdateCourseRequest;
use App\Http\Requests\AdminController\UpdateLessonRequest;
use App\Http\Requests\AdminController\UpdateUserRequest;
use App\Http\Requests\AdminController\ViewCourseRequest;
use App\Http\Requests\LessonController\StoreRequestStep1;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CustomRole;
use App\Models\Lesson;
use App\Models\LessonType;
use App\Models\User;
use App\Models\UserProfile;
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
        // Lo que ha escrito en el buscador
        $search = $request->input('search');

        // Filtros que ha marcado
        $porNombre = $request->input('name');
        $PorGuard_name = $request->input('guard_name');
        $porStatus = $request->input('status');
        $porOrden = $request->input('orden');

        // Guardamos todos los campos para mantenerlos en la vista
        $input = $request->all();

        // Traemos todos los roles, incluidos los borrados
        $query = CustomRole::withTrashed();

        // Aplicamos los filtros que haya seleccionado
        if ($porNombre) {
            $query->where('name', 'LIKE', "%$search%");
        }

        if ($PorGuard_name) {
            $query->where('guard_name', 'LIKE', "%$search%");
        }

        if ($porNombre && $PorGuard_name) {
            $query->where('name', 'LIKE', "%$porNombre%")
                ->where('guard_name', 'LIKE', "%$PorGuard_name%");
        }

        if ($porStatus === 'todos') {
            $query->whereNotNull('deleted_at')->orWhereNull('deleted_at');
        } else if ($porStatus === 'activo') {
            $query->whereNull('deleted_at');
        } else if ($porStatus === 'inactivo') {
            $query->whereNotNull('deleted_at');
        }

        // Busqueda general por todos los campos
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('guard_name', 'LIKE', "%$search%");
            });
        }

        // Ordenamos si ha elegido algun orden
        if ($porOrden) {
            if ($porOrden === 'asc' || $porOrden === 'desc') {
                $query->orderBy('name', $porOrden)
                    ->orderBy('guard_name', $porOrden);
            }
        }

        // Paginamos de 5 en 5
        $roles = $query->paginate(5)->appends($request->except('page'));

        // Devolvemos la vista con lo que hemos encontrado

        return view('admin.listadoRoles', compact('roles', 'input'));
    }

    public function searchCategories(Request $request)
    {
        // Lo que ha escrito en el buscador
        $keywords = $request->input('search');

        // Filtros seleccionados
        $name = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $status = $request->input('status');
        $orden = $request->input('orden');

        // Guardamos todo para mantener los valores en la vista
        $input = $request->all();

        // Traemos todas las categorias, incluidas las eliminadas
        $query = CourseCategory::withTrashed();

        // Aplicamos los filtros
        if ($name) {
            $query->where('name', 'LIKE', "%$keywords%");
        }

        if ($descripcion) {
            $query->where('description', 'LIKE', "%$keywords%");
        }

        if ($status === 'todos') {
        } else if ($status === 'activo') {
            $query->whereNull('deleted_at');
        } else if ($status === 'inactivo') {
            $query->whereNotNull('deleted_at');
        }

        // Busqueda general
        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->where('name', 'LIKE', "%$keywords%")
                    ->orWhere('description', 'LIKE', "%$keywords%");
            });
        }

        // Orden
        if ($orden) {
            if ($orden === 'asc' || $orden === 'desc') {
                $query->orderBy('name', $orden)
                    ->orderBy('description', $orden);
            }
        }

        // Paginamos los resultados
        $categories = $query->paginate(5)->appends($request->except('page'));

        // Devolvemos la vista
        return view('admin.listadoCategorias', compact('categories', 'input'));
    }

    // Buscar cursos con filtros
    public function searchCourses(Request $request)
    {
        // Texto del buscador
        $keywords = $request->input('search');

        // Filtros
        $name = $request->input('nombre');
        $breve_descripcion = $request->input('breve_descripcion');
        $descripcion = $request->input('descripcion');
        $language = $request->input('language');
        $status = $request->input('status');
        $orden = $request->input('orden');

        // Guardamos todos los campos
        $input = $request->all();

        // Traemos todos los cursos, incluidos los eliminados
        $query = Course::withTrashed();

        // Aplicamos los filtros
        if ($name) {
            $query->where('name', 'LIKE', "%$keywords%");
        }

        if ($breve_descripcion) {
            $query->where('short_description', 'LIKE', "%$keywords%");
        }

        if ($descripcion) {
            $query->where('description', 'LIKE', "%$keywords%");
        }

        if ($language !== 'todos') {
            $query->where('language', 'LIKE', "%$language%");
        }

        if ($status === 'todos') {
        } else if ($status === 'activo') {
            $query->whereNull('deleted_at');
        } else if ($status === 'inactivo') {
            $query->whereNotNull('deleted_at')
                ->where(function ($query) {
                    $query->where('validated', 1)
                        ->orWhereNull('validated');
                });
        } else if ($status === 'aValidar') {
            $query->where('validated', 0)
                ->whereRaw('deleted_at = updated_at');
        }

        // Busqueda general por todos los campos
        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->where('name', 'LIKE', "%$keywords%")
                    ->orWhere('short_description', 'LIKE', "%$keywords%")
                    ->orWhere('description', 'LIKE', "%$keywords%")
                    ->orWhere('language', 'LIKE', "%$keywords%");
            });
        }

        if ($orden) {
            if ($orden === 'asc' || $orden === 'desc') {
                $query->orderBy('name', $orden)
                    ->orderBy('short_description', $orden)
                    ->orderBy('description', $orden)
                    ->orderBy('language', $orden);
            }
        }

        $courses = $query->paginate(5)->appends($request->except('page'));
        $languages = Course::select('language')->distinct()->pluck('language');

        return view('admin.listadoCursos', compact('courses', 'input', 'languages'));
    }


    // Buscar usuarios con filtros

    public function searchUsers(Request $request)
    {
        // Texto del buscador
        $search = $request->input('search');

        // Filtros seleccionados
        $porUsername = $request->input('username');
        $porEmail = $request->input('email');
        $porNombre = $request->input('nombre');
        $porApellido = $request->input('apellido1');
        $porSegundoApellido = $request->input('apellido2');
        $porFechaNacimiento = $request->input('fecha_nacimiento');
        $porGenero = $request->input('biological_gender');
        $porRol = $request->input('role');
        $porStatus = $request->input('status');
        $porOrden = $request->input('orden');

        // Guardamos todo
        $input = $request->all();

        // Traemos todos los usuarios, incluidos los eliminados
        $query = User::withTrashed();

        // Aplicamos los filtros
        if ($porUsername) {
            $query->where('username', 'LIKE', "%$search%");
        }

        if ($porEmail) {
            $query->where('email', 'LIKE', "%$search%");
        }

        if ($porNombre) {
            $query->whereHas('profile', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            });
        }

        if ($porApellido) {
            $query->whereHas('profile', function ($q) use ($search) {
                $q->where('surname', 'LIKE', "%$search%");
            });
        }

        if ($porSegundoApellido) {
            $query->whereHas('profile', function ($q) use ($search) {
                $q->where('second_surname', 'LIKE', "%$search%");
            });
        }

        if ($porFechaNacimiento) {
            $query->whereHas('profile', function ($q) use ($porFechaNacimiento) {
                $q->where('birthdate', 'LIKE', "%$porFechaNacimiento%");
            });
        }

        if ($porGenero !== 'todos') {
            $query->whereHas('profile', function ($q) use ($porGenero) {
                $q->where('biological_gender', 'LIKE', "%$porGenero%");
            });
        }

        if ($porRol !== 'todos') {
            $query->whereHas('roles', function ($q) use ($porRol) {
                $q->where('id', 'LIKE', "%$porRol%");
            });
        }


        if ($porStatus === 'todos') {
            $query->whereNotNull('deleted_at')->orWhereNull('deleted_at');
        } else if ($porStatus === 'activo') {
            $query->whereNull('deleted_at');
        } else if ($porStatus === 'inactivo') {
            $query->whereNotNull('deleted_at');
        }

        // Busqueda general por todos los campos
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhereHas('profile', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%")
                            ->orWhere('surname', 'LIKE', "%$search%")
                            ->orWhere('second_surname', 'LIKE', "%$search%")
                            ->orWhere('birthdate', 'LIKE', "%$search%")
                            ->orWhere('biological_gender', 'LIKE', "%$search%");
                    })
                    ->orWhereHas('roles', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%");
                    });
            });
        }

        // Ordenamos los resultados
        if ($porOrden) {
            if ($porOrden === 'asc' || $porOrden === 'desc') {
                $query->orderBy('username', $porOrden)
                    ->orderBy('email', $porOrden)
                    ->orderBy('created_at', $porOrden);
            }
        }

        // Paginamos
        $users = $query->paginate(5)->appends($request->except('page'));
        $roles = Role::whereHas('users')->get();

        // Devolvemos la vista
        return view('admin.listadoUsuario', compact('users', 'input', 'roles'));
    }

    // Listado de todos los usuarios
    public function listUsers()
    {
        $roles = Role::whereHas('users')->get();
        $users = User::withTrashed()->paginate(5);
        $input = [];
        return view('admin.listadoUsuario', compact('users', 'roles', 'input'));
    }

    // Listado de todos los cursos
    public function listCourses()
    {

        $languages = Course::select('language')->distinct()->pluck('language');
        $courses = Course::withTrashed()->paginate(5);
        $input = [];
        return view('admin.listadoCursos', compact('courses', 'languages', 'input'));
    }

    // Listado de todas las categorias
    public function listCategories()
    {
        $categories = CourseCategory::withTrashed()->paginate(5);
        $input = [];
        return view('admin.listadoCategorias', compact('categories', 'input'));
    }

    // Listado de todos los roles
    public function listRoles()
    {
        $roles = CustomRole::withTrashed()->paginate(5);
        $input = [];
        return view('admin.listadoRoles', compact('roles', 'input'));
    }

    // Guarda un curso nuevo
    public function storeCourse(StoreCourseRequest $request)
    {
        $request->safe();

        $curso = Course::create([
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'language' => $request->input('language'),
            'price' => $request->input('price'),
            'owner_id' => $request->input('owner_id'),
            'courses_categories_id' => $request->input('courses_categories_id'),
        ]);

        // Lo dejamos desactivado, ya se activara cuando este listo
        $curso->delete();


        // Si sube una imagen la guardamos, si no le ponemos una por defecto
        if ($request->hasFile('imageCourse')) {
            $curso->addMediaFromRequest('imageCourse')->toMediaCollection('courses_images');
        } else {
            $curso->addMediaFromUrl('https://i.postimg.cc/HkL86Lc1/sinfoto.png')->toMediaCollection('courses_images');
        }

        return redirect()->route('listCourses');
    }

    // Actualiza los datos de un curso

    public function updateCourse(UpdateCourseRequest $request)
    {
        $request->safe();

        $curso = Course::withTrashed()->find($request->id);
        $curso->name = $request->name;
        $curso->short_description = $request->short_description;
        $curso->description = $request->description;
        $curso->language = $request->language;
        $curso->price = $request->price;
        $curso->owner_id = $request->owner_id;
        $curso->courses_categories_id = $request->courses_categories_id;

        $curso->validated = null;
        $curso->updated_at = now();
        $curso->deleted_at = now()->subSeconds(1);

        $curso->save();

        if ($request->hasFile('imageCourse')) {
            $curso->addMediaFromRequest('imageCourse')->toMediaCollection('courses_images');
        }

        return redirect()->route('listCourses')->with('success', 'Curso editado correctamente');
    }

    // Muestra el formulario para crear un curso
    public function createCourse(): View
    {
        $users = User::withTrashed()->get();
        $categories = CourseCategory::all();
        return view('admin.createCourse', compact('users', 'categories'));
    }

    // Muestra el formulario para editar un curso
    public function editCourse(Request $request, Course $course): View
    {
        $users = user::withTrashed()->get();
        $categories = CourseCategory::all();
        $lessons = Lesson::where('courses_id', $request->id)->get();
        $courseInfo = Course::withTrashed()->find($request->id);
        $lessons = Lesson::where('courses_id', $request->id)->get();

        return view('admin.editCourse', [
            'users' => $users,
            'categories' => $categories,
            'lessons' => $lessons,
            'courseInfo' => $courseInfo,
            'lessons' => $lessons,
        ]);
    }

    // Muestra el formulario para crear una categoria
    public function createCategory(): View
    {
        return view('admin.createCategory');
    }

    // Guarda una categoria nueva
    public function storeCategory(StoreCategoryRequest $request)
    {
        $request->safe();



        // Creamos la categoria con los datos del formulario
        $category = CourseCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        if ($request->hasFile('imageCategory')) {
            $category->addMediaFromRequest('imageCategory')->toMediaCollection('images_categories');
        }

        $category->delete();

        // Redirigimos al listado
        return redirect()->route('listCategories')->with('success', 'Categoría creada correctamente');
    }

    // Muestra el formulario para crear un rol
    public function createRole(): View
    {
        return view('admin.createRole');
    }

    // Guarda un rol nuevo
    public function storeRole(StoreRoleRequest $request)
    {
        $request->safe();



        // Creamos el rol
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => $request->input('guard_name'),
        ]);

        // Redirigimos al listado
        return redirect()->route('listRoles')->with('success', 'Rol creado correctamente');
    }

    // Muestra el formulario para crear un usuario
    public function createUser(): View
    {
        $roles = Role::all();

        return view('admin.new-user', compact('roles'));
    }

    // Guarda un usuario nuevo
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

    // Desactiva una categoria (borrado logico)
    public function destroyCategory(CourseCategory $category)
    {
        $category->delete();

        // return redirect()->route('listCategories')->with('success', 'Categoría eliminada correctamente');
        return back();
    }

    // Reactiva una categoria que estaba desactivada
    public function activateCategory(Request $category)
    {
        $category = CourseCategory::withTrashed()->find($category->category);

        $category->restore();

        // return redirect()->route('listCategories')->with('success', 'Categoría activada correctamente');
        return back();
    }

    // Elimina una categoria de forma permanente
    public function forceDestroyCategory(Request $category)
    {
        $category = CourseCategory::withTrashed()->find($category->id);

        $category->forceDelete();

        // return redirect()->route('listCategories')->with('success', 'Categoría eliminada permanentemente');
        return back();
    }

    // Muestra el formulario para editar una categoria
    public function editCategoryView(Request $category): View
    {
        $category = CourseCategory::withTrashed()->find($category->category);

        return view('admin.editCategory', compact('category'));
    }

    // Actualiza los datos de una categoria
    public function editCategory(EditCategoryRequest $request)
    {
        $request->safe();

        $category = CourseCategory::withTrashed()->find($request->id);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->hasFile('imageCategory')) {
            $category->addMediaFromRequest('imageCategory')->toMediaCollection('images_categories');
        }

        return redirect()->route('listCategories')->with('success', 'Categoría editada correctamente');
    }

    // Muestra el formulario para editar un rol
    public function editRoleView(Request $request): View
    {
        $id = $request->id;

        $role = CustomRole::withTrashed()->where('id', $id)->first();

        return view('admin.editRole', compact('role'));
    }

    // Actualiza los datos de un rol
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

    // Reactiva un rol que estaba desactivado
    public function activateRole(Request $request)
    {
        $id = $request->id;

        $role = CustomRole::withTrashed()->where('id', $id)->first();

        $role->restore();

        // return redirect()->route('listRoles')->with('success', 'Rol activado correctamente');
        return back();
    }

    // Desactiva un rol (borrado logico)
    public function destroyRole(Request $request)
    {
        $id = $request->id;

        $role = CustomRole::withTrashed()->where('id', $id)->first();

        $role->delete();

        // return redirect()->route('listRoles')->with('success', 'Rol desactivado correctamente');
        return back();
    }

    // Elimina un rol de forma permanente
    public function forceDestroyRole(Request $request)
    {
        $id = $request->id;
        $guardName = $request->guard_name;

        // Si no encuentra el guard no deja borrarlo
        $role = CustomRole::withTrashed()->where('id', $id)->where('guard_name', $guardName)->first();

        $role->forceDelete();

        // return redirect()->route('listRoles')->with('success', 'Rol eliminado permanentemente');
        return back();
    }

    // Muestra el formulario para editar un usuario
    public function editUser($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $userProfile = UserProfile::where('user_id', $user->id)->first();
        $roles = Role::all();

        return view('admin.editUser', compact('user', 'roles', 'userProfile'));
    }

    // Actualiza los datos de un usuario
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

        // Comprobamos si le han asignado un rol
        $role = $request->validated()['role'] ?? null;

        if ($role) {
            // Le asignamos el rol nuevo
            $roleName = Role::findById($role);
            $user->syncRoles([$roleName]);
        } else if ($request->input('role') == null) {
            $user->syncRoles([]);
        }

        // Si sube nueva foto de perfil
        if ($request->hasFile('avatar')) {
            // Quitamos la que tenia antes
            $userProfile->clearMediaCollection('users_avatar');
            // Subimos la nueva
            $userProfile->addMediaFromRequest('avatar')->toMediaCollection('users_avatar');
        } elseif ($request->input('avatar-remove') == 1) {
            $userProfile->clearMediaCollection('users_avatar');
        }

        return Redirect::route('listUsers')->with('success', 'Usuario actualizado correctamente');
    }

    // Reactiva un usuario que estaba desactivado
    public function activateUser(Request $request)
    {
        $user = User::withTrashed()->find($request->id);
        $user->restore();

        // return redirect()->route('listUsers');
        return back();
    }

    // Desactiva un usuario (borrado logico)
    public function disableUser(User $user)
    {
        $user->delete();

        // return redirect()->route('listUsers');
        return back();
    }

    // Elimina un usuario de forma permanente. Sus cursos pasan a la cuenta global de la app
    public function deleteUser($id)
    {
        // Cogemos todos los cursos que tenia este usuario
        $courses = Course::withTrashed()->where('owner_id', $id)->get();

        // Buscamos la cuenta global de la aplicacion
        $academy = User::where('username', 'studyhub-app')->first();

        // Pasamos cada curso a la cuenta global para que los compradores no los pierdan
        foreach ($courses as $course) {
            $course->owner_id = $academy->id;
            $course->save();
        }

        // Ahora si borramos al usuario
        $user = User::withTrashed()->find($id);
        $user->forceDelete();

        // return redirect()->route('listUsers');
        return back();
    }

    // Activa un curso (lo valida y lo hace visible)
    public function activateCourse(Request $request)
    {
        $course = Course::withTrashed()->find($request->id);

        if (($course->deleted_at == $course->updated_at && $course->validated === 0) || ($course->deleted_at == $course->updated_at && $course->validated === 1)) {
            $course->validated = 1;
            $course->restore();
            return back();
        } else if ($course->deleted_at !== null && $course->validated === null) {
            $course->validated = 1;
            $course->restore();
            return back();
        } else {
            return back();
        }

        // return redirect()->route('listCourses');
    }

    // Desactiva un curso (deja de ser visible)
    public function disableCourse(Course $course)
    {
        $course->delete();

        // return redirect()->route('listCourses');
        return back();
    }

    // Elimina un curso de forma permanente
    public function deleteCourse($id)
    {
        $course = Course::withTrashed()->find($id);
        $course->forceDelete();

        // return redirect()->route('listCourses');
        return back();
    }

    // Formulario para crear una leccion (paso 1: titulo y subtitulo)

    public function createLessonStep1($id): View
    {
        $curso = Course::withTrashed()->find($id);

        // Miramos si ya tiene alguna leccion creada
        $hasLessons = Lesson::where('courses_id', $id)->exists();

        return view('admin.createLessonStep1', compact('curso', 'hasLessons'));
    }

    // Guarda la leccion (paso 1: titulo y subtitulo)
    public function storeLessonStep1(StoreLessonRequestStep1 $request, $id)
    {

        $request->safe();

        $courseId = $request->route('id');

        $lesson = Lesson::create([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'courses_id' => $courseId,
            'lessons_types_id' => '1',
        ]);

        $lessonId = $lesson->id;

        $course = Course::withTrashed()->find($courseId);

        $course->validated = null;
        $course->updated_at = now();
        $course->deleted_at = now()->subSeconds(1);
        $course->save();

        return redirect()->route('admin.createLessonStep2', ['id' => $courseId, 'lessonId' => $lessonId]);
    }

    // Formulario para crear una leccion (paso 2: contenido)

    public function createLessonStep2($id, $lessonId): View
    {
        $curso = Course::withTrashed()->find($id);

        return view('admin.createLessonStep2', compact('curso', 'lessonId'));
    }

    // Guarda el contenido de la leccion (paso 2)
    public function storeLessonStep2(StoreLessonRequestStep2 $request, $id)
    {

        $request->safe();

        $courseId = $request->route('id');

        $lesson = Lesson::where('courses_id', $courseId)->latest()->first();

        if ($request->hasFile('media')) {

            $lesson->update([
                'lessons_types_id' => $request->input('content_type'),
                'content' => null,
            ]);

            $lesson->addMediaFromRequest('media')->toMediaCollection('lesson_content');
        } else {

            $lesson->update([
                'lessons_types_id' => $request->input('content_type'),
                'content' => $request->input('content'),
            ]);
        }

        $hasLessons = Lesson::where('courses_id', $courseId)->exists();

        $course = Course::withTrashed()->find($courseId);

        $course->validated = null;
        $course->updated_at = now();
        $course->deleted_at = now()->subSeconds(1);
        $course->save();

        return redirect()->route('admin.createLessonStep1', ['id' => $courseId])->with(compact('hasLessons'));
    }

    // Muestra el formulario para editar una leccion
    public function editLesson(Request $request)
    {
        $lesson = Lesson::where('id', $request->id)->first();
        $lessonType = LessonType::where('id', $lesson->lessons_types_id)->first();
        $data = $lesson->content;

        return view('admin.updateLesson', [
            'lesson' => $lesson,
            'lessonType' => $lessonType,
            'data' => $data,
        ]);
    }

    // Actualiza los datos de una leccion
    public function updateLesson(UpdateLessonRequest $request)
    {
        $request->safe();

        $lesson = Lesson::find($request->id);
        $lesson->title = $request->title;
        $lesson->subtitle = $request->subtitle;

        if ($lesson->lessons_types_id == 5) {
            $lesson->content = $request->content;
        } else {
            if ($request->hasFile('media')) {
                $lesson->addMediaFromRequest('media')->toMediaCollection('lesson_content');
            }
        }

        $lesson->save();

        $courseId = $lesson->courses_id;
        $course = Course::withTrashed()->find($courseId);
        $course->validated = null;
        $course->updated_at = now();
        $course->deleted_at = now()->subSeconds(1);
        $course->save();

        return redirect()->route('admin.editCourse', ['id' => $courseId]);
    }

    // Borra una leccion de forma permanente
    public function deleteLesson($id)
    {
        $lesson = Lesson::find($id);
        $lesson->forceDelete();

        return back();
    }

    // Vista previa de un curso desde el panel de admin

    public function viewCourse(ViewCourseRequest $request, $id)
    {
        $course = Course::withTrashed()->find($id);
        $lessons = Lesson::where('courses_id', $course->id)->get();

        // Empezamos sin leccion seleccionada
        $lesson = null;
        $data = null;

        // Si ha seleccionado una leccion, la guardamos
        if (!$request->input('leccion') == null) {
            $lesson = Lesson::find($request->input('leccion'));
            $request->session()->put('leccion', $lesson->id);

            if ($lesson->lessons_types_id == 5) {
                $data = $lesson->content;
            }
        } else {
            $request->session()->put('leccion', 0);
        }



        // Devolvemos la vista con todo lo necesario
        return view('admin.viewCourse', [
            'course' => $course,
            'lessons' => $lessons,
            'lesson' => $lesson,
            'data' => $data,
        ])->with('lesson', $lesson);
    }
}
