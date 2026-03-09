<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Suspender cuenta') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Una vez que se suspenda su cuenta, ésta quedará inactiva y no podrá acceder a la información almacenada en ella. Para reactivarla deberá contactar con el administrador de la aplicación.') }}
        </p>
    </header>

    <x-danger-outlined-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirmar-suspension-cuenta')"
    >{{ __('Suspender cuenta') }}</x-danger-outlined-button>

    <x-modal name="confirmar-suspension-cuenta" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('¿Estás seguro de suspender tu cuenta?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Una vez que se suspenda su cuenta, ésta quedará inactiva y no podrá acceder a la información almacenada en ella. Para reactivarla deberá contactar con el administrador de la aplicación.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Suspender cuenta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
