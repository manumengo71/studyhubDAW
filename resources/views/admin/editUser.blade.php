<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="flex items-center justify-center p-12">
            <div class="mx-auto w-full">
                <form action="{{ route('updateUser', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    {{-- 1 --}}
                    <div class="mb-5">
                        <div class="flex space-x-4">
                            <div class="w-1/3">
                                <label for="username" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Username
                                </label>
                                <input type="text" name="username" id="username" value={{ $user->username }}
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('username')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-1/3">
                                <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Email
                                </label>
                                <input type="email" name="email" id="email" value={{ $user->email }}
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('email')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-1/3">
                                <label for="password" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Contraseña
                                </label>
                                <input type="text" name="password" id="password" placeholder="***********"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('password')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- 2 --}}
                    <div class="mb-5">
                        <div class="flex space-x-4">
                            <div class="w-1/3">
                                <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Nombre
                                </label>
                                <input type="text" name="name" id="name"
                                    value="{{ isset($userProfile->name) ? $userProfile->name : 'Nombre' }}"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-1/3">
                                <label for="surname" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Primer Apellido
                                </label>
                                <input type="text" name="surname" id="surname"
                                    value="{{ isset($userProfile->surname) ? $userProfile->surname : 'Primer Apellido' }}"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('surname')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-1/3">
                                <label for="second_surname" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Segundo Apellido
                                </label>
                                <input type="text" name="second_surname" id="second_surname"
                                    value="{{ isset($userProfile->second_surname) ? $userProfile->second_surname : 'Segundo Apellido' }}"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('second_surname')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- 3 --}}
                    <div class="mb-5">
                        <div class="flex space-x-4">
                            <div class="w-1/4">
                                <label for="birthdate" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Fecha de Nacimiento
                                </label>
                                <input type="date" name="birthdate" id="birthdate"
                                @if (isset($userProfile->birthdate))
                                    value="{{ $userProfile->birthdate->format('Y-m-d') }}"
                                @endif
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                                @error('birthdate')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-1/4">
                                <label for="gender" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Género Biológico
                                </label>
                                <select name="gender" id="gender"
                                    class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:border-indigo-500 md:h-12">
                                    <option value="" disabled {{ (!$userProfile->biological_gender) ? 'selected' : '' }}>
                                        @if (!$userProfile->biological_gender)
                                            Género sin especificar
                                        @else
                                            {{ $userProfile->biological_gender }}
                                        @endif
                                    </option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                                @error('gender')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-1/4">
                                <label for="role" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Rol
                                </label>
                                <select name="role" id="role"
                                    class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:border-indigo-500 md:h-12">
                                    <option value="" disabled selected>
                                        @if ($user->roles->isEmpty())
                                            Sin Rol
                                        @else
                                            {{ $user->roles->first()->name }}
                                        @endif
                                    </option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-1/4">
                                <label for="avatar" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Foto de Perfil
                                </label>
                                <x-input-label for="avatar" />
                                @if ($userProfile->getMedia('users_avatar')->count() > 0)
                                    <input type="file" name="avatar" class="dropify"
                                        data-default-file="{{ $userProfile->getMedia('users_avatar')->last()->getUrl() }}" />
                                @else
                                    <input type="file" name="avatar" class="dropify"
                                        data-default-file="https://i.postimg.cc/DyXwcTHj/profile.png" />
                                @endif
                                <input type="hidden" id="avatar-remove" name="avatar-remove" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="hover:shadow-form rounded-md bg-indigo-500 py-3 px-8 text-base font-semibold text-white outline-none">
                            Editar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

</x-app-layout>
