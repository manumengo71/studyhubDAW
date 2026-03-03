<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información del perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Actualiza tu información personal.") }}
        </p>
    </header>

    <form method="post" action="{{ route('userprofile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>

            <x-input-label for="avatar" :value="__('Avatar')" />
            @if (Auth::user()->profile->getMedia('users_avatar')->count() > 0)
                <input type="file" name="avatar" class="dropify"
                    data-default-file="{{ Auth::user()->profile->getMedia('users_avatar')->last()->getUrl() }}" />
            @else
                <input type="file" name="avatar" class="dropify" data-default-file="https://i.postimg.cc/DyXwcTHj/profile.png"/>
            @endif
            <input type="hidden" id="avatar-remove" name="avatar-remove" value="0">
        </div>
        {{-- <div class="shadow-lg h-full w-40 flex items-center justify-center mx-auto">
            @if (Auth::user()->profile->getMedia('users_avatar')->count() > 0)
                <img src="{{ Auth::user()->profile->getMedia('users_avatar')->last()->getUrl() }}" class="w-40 border-4 border-white rounded-full">
            @else
            <input type="file" id="avatar" name="avatar">
            @endif
        </div> --}}

        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', optional($userProfile)->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="surname" :value="__('Primer apellido')" />
            <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full" :value="old('surname', optional($userProfile)->surname)" required autofocus autocomplete="surname" />
            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
        </div>

        <div>
            <x-input-label for="second_surname" :value="__('Segundo apellido')" />
            <x-text-input id="second_surname" name="second_surname" type="text" class="mt-1 block w-full" :value="old('second_surname', optional($userProfile)->second_surname)" required autofocus autocomplete="second_surname" />
            <x-input-error class="mt-2" :messages="$errors->get('second_surname')" />
        </div>

        <div>
            <x-input-label for="birthdate" :value="__('Cumpleaños')" />
            <x-text-input id="birthdate" name="birthdate" type="text" onfocus="(this.type='date')" class="mt-1 block w-full" :value="old('birthdate', optional($userProfile->birthdate)->format('d/m/Y'))" required autofocus autocomplete="birthdate" />
            <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
        </div>

        <div>
            <x-input-label for="biological_gender" :value="__('Género biológico')" />
            <x-select-input id="biological_gender" name="biological_gender" class="mt-1 block w-full" :value="old('biological_gender', optional($userProfile)->biological_gender)" required>
                <option value="Masculino" {{ old('biological_gender', optional($userProfile)->biological_gender) === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ old('biological_gender', optional($userProfile)->biological_gender) === 'Femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ old('biological_gender', optional($userProfile)->biological_gender) === 'Otro' ? 'selected' : '' }}>Otro</option>
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('biological_gender')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    <script>
        $('.dropify').on('dropify.afterClear', function(event, element) {
            $('#avatar-remove').val('1');
        });
    </script>
</section>
