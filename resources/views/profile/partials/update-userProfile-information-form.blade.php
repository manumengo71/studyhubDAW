<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('User Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your personal information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('userprofile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', optional($userProfile)->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="surname" :value="__('Surname')" />
            <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full" :value="old('surname', optional($userProfile)->surname)" required autofocus autocomplete="surname" />
            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
        </div>

        <div>
            <x-input-label for="second_surname" :value="__('Second Surname')" />
            <x-text-input id="second_surname" name="second_surname" type="text" class="mt-1 block w-full" :value="old('second_surname', optional($userProfile)->second_surname)" required autofocus autocomplete="second_surname" />
            <x-input-error class="mt-2" :messages="$errors->get('second_surname')" />
        </div>

        <div>
            <x-input-label for="birthdate" :value="__('Birthdate')" />
            <x-text-input id="birthdate" name="birthdate" type="text" onfocus="(this.type='date')" class="mt-1 block w-full" :value="old('birthdate', optional($userProfile)->birthdate->format('d/m/Y'))" required autofocus autocomplete="birthdate" />
            <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
        </div>

        <div>
            <x-input-label for="biological_gender" :value="__('Biological Gender')" />
            <x-select-input id="biological_gender" name="biological_gender" class="mt-1 block w-full" :value="old('biological_gender', optional($userProfile)->biological_gender)" required>
                <option value="Masculino" {{ old('biological_gender', optional($userProfile)->biological_gender) === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ old('biological_gender', optional($userProfile)->biological_gender) === 'Femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ old('biological_gender', optional($userProfile)->biological_gender) === 'Otro' ? 'selected' : '' }}>Otro</option>
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('biological_gender')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
