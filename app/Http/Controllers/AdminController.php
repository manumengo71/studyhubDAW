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
use App\Http\Requests\LessonController\StoreRequestStep1;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CustomRole;
use App\Models\Lesson;
use App\Models\LessonType;
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
        /** Input */
        $search = $request->input('search');

        /** Filtros */
        $porNombre = $request->input('name');
        $PorGuard_name = $request->input('guard_name');
        $porStatus = $request->input('status');
        $porOrden = $request->input('orden');

        /** Inputs */
        $input = $request->all();

        /** Query */
        $query = CustomRole::withTrashed();

        /** Aplicar filtros */
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

        /** Aplicar búsqueda global */
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('guard_name', 'LIKE', "%$search%");
            });
        }

        /** Aplicar orden */
        if ($porOrden) {
            if ($porOrden === 'asc' || $porOrden === 'desc') {
                $query->orderBy('name', $porOrden)
                    ->orderBy('guard_name', $porOrden);
            }
        }

        /** Paginar los resultados */
        $roles = $query->paginate(5)->appends($request->except('page'));

        /** Devolver la vista con los resultados */

        return view('admin.listadoRoles', compact('roles', 'input'));
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
        $query = CourseCategory::withTrashed();

        // Aplicar filtros
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

        // Aplicar búsqueda global
        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->where('name', 'LIKE', "%$keywords%")
                    ->orWhere('description', 'LIKE', "%$keywords%");
            });
        }

        //Orden de búsqueda
        if ($orden) {
            if ($orden === 'asc' || $orden === 'desc') {
                $query->orderBy('name', $orden)
                    ->orderBy('description', $orden);
            }
        }

        // Paginar los resultados
        $categories = $query->paginate(5)->appends($request->except('page'));

        // Devolver la vista con los resultados
        return view('admin.listadoCategorias', compact('categories', 'input'));
    }

    /**
     * Buscar cursos
     */
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
        $query = Course::withTrashed();

        // Aplicar filtros
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

        // Aplicar búsqueda global
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


    /**
     * Buscar usuarios
     */

    public function searchUsers(Request $request)
    {
        // Input
        $search = $request->input('search');

        // Filtros
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

        // Inputs
        $input = $request->all();

        // Query
        $query = User::withTrashed();

        // Aplicar filtros
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

        // Aplicar búsqueda global
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

        // Aplicar orden
        if ($porOrden) {
            if ($porOrden === 'asc' || $porOrden === 'desc') {
                $query->orderBy('username', $porOrden)
                    ->orderBy('email', $porOrden)
                    ->orderBy('created_at', $porOrden);
            }
        }

        // Paginar los resultados
        $users = $query->paginate(5)->appends($request->except('page'));
        $roles = Role::whereHas('users')->get();

        // Devolver la vista con los resultados
        return view('admin.listadoUsuario', compact('users', 'input', 'roles'));
    }

    /**
     * Listar usuarios
     */
    public function listUsers()
    {
        $roles = Role::whereHas('users')->get();
        $users = User::withTrashed()->paginate(5);
        $input = [];
        return view('admin.listadoUsuario', compact('users', 'roles', 'input'));
    }

    /**
     * Listar cursos
     */
    public function listCourses()
    {

        $languages = Course::select('language')->distinct()->pluck('language');
        $courses = Course::withTrashed()->paginate(5);
        $input = [];
        return view('admin.listadoCursos', compact('courses', 'languages', 'input'));
    }

    /**
     * Listar categorías
     */
    public function listCategories()
    {
        $categories = CourseCategory::withTrashed()->paginate(5);
        $input = [];
        return view('admin.listadoCategorias', compact('categories', 'input'));
    }

    /**
     * Listar roles
     */
    public function listRoles()
    {
        $roles = CustomRole::withTrashed()->paginate(5);
        $input = [];
        return view('admin.listadoRoles', compact('roles', 'input'));
    }

    /**
     * Crear un curso
     */
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

    /**
     * Editar un curso
     */

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
        $curso->save();

        if ($request->hasFile('imageCourse')) {
            $curso->addMediaFromRequest('imageCourse')->toMediaCollection('courses_images');
        }

        return redirect()->route('listCourses')->with('success', 'Curso editado correctamente');
    }

    /**
     * Redirigir a la vista para crear un curso
     */
    public function createCourse(): View
    {
        $users = User::withTrashed()->get();
        $categories = CourseCategory::all();
        return view('admin.createCourse', compact('users', 'categories'));
    }

    /**
     * Redirigir a la vista para editar un curso
     */
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

    /**
     * Redirigir a la vista para crear una categoría
     */
    public function createCategory(): View
    {
        return view('admin.createCategory');
    }

    /**
     * Crear una categoría
     */
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

    /**
     * Redirigir a la vista para crear un rol
     */
    public function createRole(): View
    {
        return view('admin.createRole');
    }

    /**
     * Crear un rol
     */
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

    /**
     * Redirigir a la vista para crear un usuario
     */
    public function createUser(): View
    {
        $roles = Role::all();

        return view('admin.new-user', compact('roles'));
    }

    /**
     * Crear un usuario
     */
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

        // return redirect()->route('listCategories')->with('success', 'Categoría eliminada correctamente');
        return back();
    }

    /**
     * Activar una categoría
     *
     */
    public function activateCategory(Request $category)
    {
        $category = CourseCategory::withTrashed()->find($category->category);

        $category->restore();

        // return redirect()->route('listCategories')->with('success', 'Categoría activada correctamente');
        return back();
    }

    /**
     * Eliminar una categoría
     *
     */
    public function forceDestroyCategory(Request $category)
    {
        $category = CourseCategory::withTrashed()->find($category->id);

        $category->forceDelete();

        // return redirect()->route('listCategories')->with('success', 'Categoría eliminada permanentemente');
        return back();
    }

    /**
     * Redirigir a la vista para editar una categoría
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
     * Redirigir a la vista para editar un curso
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

        // return redirect()->route('listRoles')->with('success', 'Rol activado correctamente');
        return back();
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

        // return redirect()->route('listRoles')->with('success', 'Rol desactivado correctamente');
        return back();
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

        // return redirect()->route('listRoles')->with('success', 'Rol eliminado permanentemente');
        return back();
    }

    /**
     * Redirigir a la vista para editar un curso
     *
     */
    public function editUser($id)
    {
        $user = User::withTrashed($id)->first();
        // $user = User::findOrFail($id);
        $userProfile = UserProfile::where('user_id', $user->id)->first();
        $roles = Role::all();

        return view('admin.editUser', compact('user', 'roles', 'userProfile'));
    }

    /**
     * Editar un usuario
     *
     */
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

    /**
     * Activar un usuario
     *
     */
    public function activateUser(Request $request)
    {
        $user = User::withTrashed()->find($request->id);
        $user->restore();

        // return redirect()->route('listUsers');
        return back();
    }

    /**
     * Desactivar un usuario
     *
     */
    public function disableUser(User $user)
    {
        $user->delete();

        // return redirect()->route('listUsers');
        return back();
    }

    /**
     * Eliminar un usuario
     *
     */
    public function deleteUser($id)
    {
        // Obtener todos los cursos del usuario
        $courses = Course::where('owner_id', $id)->get();

        // Obtener id del usuario StudyHub-App
        $academy = User::where('username', 'StudyHub-App')->first();

        // Modificar el owner_id de cada curso
        foreach ($courses as $course) {
            $course->owner_id = $academy->id; // Modificar el owner_id según sea necesario
            $course->save(); // Guardar el curso con el nuevo owner_id
        }

        // Eliminar al usuario
        $user = User::withTrashed()->find($id);
        $user->forceDelete();

        // return redirect()->route('listUsers');
        return back();
    }

    /**
     * Activar un curso
     *
     */
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

    /**
     * Desactivar un curso
     *
     */
    public function disableCourse(Course $course)
    {
        $course->delete();

        // return redirect()->route('listCourses');
        return back();
    }

    /**
     * Eliminar un curso
     *
     */
    public function deleteCourse($id)
    {
        $course = Course::withTrashed()->find($id);
        $course->forceDelete();

        // return redirect()->route('listCourses');
        return back();
    }

    /**
     * Mostrar el formulario para crear el step 1 de una lección.
     */

    public function createLessonStep1($id): View
    {
        $curso = Course::withTrashed()->find($id);

        // Verificar si existen lecciones para este curso
        $hasLessons = Lesson::where('courses_id', $id)->exists();

        return view('admin.createLessonStep1', compact('curso', 'hasLessons'));
    }

    /**
     * Guardar el step1 de una lección en la base de datos.
     */
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

    /**
     * Mostrar el formulario para crear una nueva lección.
     */

    public function createLessonStep2($id, $lessonId): View
    {
        $curso = Course::withTrashed()->find($id);

        return view('admin.createLessonStep2', compact('curso', 'lessonId'));
    }

    /**
     * Guardar una nueva lección en la base de datos.
     */
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

    /**
     * Mostrar el formulario para editar una lección.
     */
    public function editLesson(Request $request)
    {
        $lesson = Lesson::where('id', $request->id)->first();
        $lessonType = LessonType::where('id', $lesson->lessons_types_id)->first();
        $data = $lesson->content;

        return view('lesson.updateLesson', [
            'lesson' => $lesson,
            'lessonType' => $lessonType,
            'data' => $data,
        ]);
    }

    /**
     * Actualizar una lección en la base de datos.
     */
    public function updateLesson(UpdateLessonRequest $request)
    {
        $request->safe();

        $lesson = Lesson::find($request->id);
        $lesson->title = $request->title;
        $lesson->subtitle = $request->subtitle;

        if ($lesson->lessons_types_id == 5) {
            $lesson->content = $request->content;
        }else {
            $lesson->addMediaFromRequest('media')->toMediaCollection('lesson_content');
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

    /**
     * Prueba datos Editor.js
     *
     */
    public function prueba(Request $request)
    {
        $lesson = Lesson::find(68);

        $lesson->update([
            'title' => 'EditorJS',
            'subtitle' => 'holla',
            'content' => $request->description,
            'lessons_types_id' => '5',
            'courses_id' => '35',
        ]);

        $data = $lesson->content;

        return redirect()->route('privacidad')->with('data', $data);
    }
}
