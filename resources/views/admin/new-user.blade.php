<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="flex items-center justify-center p-12">
            <div class="mx-auto w-full">
                <form action="{{ route('storeUser') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- 1 --}}
                    <div class="mb-5">
                        <div class="md:flex md:space-x-4">
                            <div class="md:w-1/3">
                                <label for="username" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Username
                                </label>
                                <input type="text" name="username" id="username" placeholder="Nombre de usuario"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('username')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:w-1/3 mt-4 md:mt-0">
                                <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Email
                                </label>
                                <input type="email" name="email" id="email"
                                    placeholder="tunombre@loquesea.com"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('email')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:w-1/3 mt-4 md:mt-0">
                                <label for="password" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Contraseña
                                </label>
                                <input type="password" name="password" id="password"
                                    placeholder="***********"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('password')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- 2 --}}
                    <div class="mb-5">
                        <div class="md:flex md:space-x-4">
                            <div class="md:w-1/3">
                                <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Nombre
                                </label>
                                <input type="text" name="name" id="name"
                                    placeholder="Nombre"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:w-1/3 mt-4 md:mt-0">
                                <label for="surname" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Primer Apellido
                                </label>
                                <input type="text" name="surname" id="surname"
                                    placeholder="Primer Apellido"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('surname')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:w-1/3 mt-4 md:mt-0">
                                <label for="second_surname" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Segundo Apellido
                                </label>
                                <input type="text" name="second_surname" id="second_surname"
                                    placeholder="Segundo Apellido"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('second_surname')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- 3 --}}
                    <div class="mb-5">
                        <div class="md:flex md:space-x-4">
                            <div class="md:w-1/4">
                                <label for="birthdate" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Fecha de Necimiento
                                </label>
                                <input type="date" name="birthdate" id="birthdate"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('birthdate')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:w-1/4 mt-4 md:mt-0">
                                <label for="gender" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Género Biológico
                                </label>
                                <select name="gender" id="gender"
                                    class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:border-indigo-500">
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                                @error('gender')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:w-1/4 mt-4 md:mt-0">
                                <label for="role" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Rol
                                </label>
                                <select name="role" id="role"
                                    class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:border-indigo-500">
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    @foreach ($roles->sortBy('name') as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('gender')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:w-1/4 mt-4 md:mt-0">
                                <label for="avatar" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Foto de Perfil
                                </label>
                                <input type="file" name="avatar" id="avatar" class="dropify"
                                    data-height="100" data-default-file="https://i.postimg.cc/DyXwcTHj/profile.png" />
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="hover:shadow-form rounded-md bg-indigo-500 py-3 px-8 text-base font-semibold text-white outline-none">
                            Crear Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

</x-app-layout>
