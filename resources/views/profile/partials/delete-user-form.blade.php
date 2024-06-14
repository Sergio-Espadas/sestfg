<section class="space-y-6">
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-100 dark:text-gray-200">
            {{ __('¿Estás seguro de que deseas eliminar tu cuenta?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400 dark:text-gray-500">
            {{ __('Una vez que se elimine tu cuenta, todos sus recursos y datos se eliminarán permanentemente. Por favor, introduce tu contraseña para confirmar que deseas eliminar tu cuenta de forma permanente.') }}
        </p>

        <div class="mt-6">
            <x-input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />

            <x-text-input id="password" name="password" type="password"
                class="mt-1 block w-3/4 @error('password', 'userDeletion') @enderror"
                placeholder="{{ __('Contraseña') }}" />

            @error('password', 'userDeletion')
            <div class="mt-2 text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-6 flex">
            <x-secondary-button x-on:click="$dispatch('close')" class="text-gray-300 dark:text-gray-500">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Borrar cuenta') }}
            </x-danger-button>
        </div>
    </form>
</section>