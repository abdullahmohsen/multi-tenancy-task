<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--text"><strong>Success!</strong> {{ session('success') }}</span>
          </div>
        @endif

        <form method="POST" action="{{ route('tenancy.store') }}">
            @csrf
            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
              <x-jet-label for="email" value="{{ __('Email') }}" />
              <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
              <x-jet-label for="password" value="{{ __('Password') }}" />
              <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
              <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
              <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="domain" value="{{ __('Domain') }}" />
                <x-jet-input id="domain" class="block mt-1 w-full" type="text" name="domain" :value="old('domain')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="database" value="{{ __('Database') }}" />
                <x-jet-input id="database" class="block mt-1 w-full" type="text" name="database" :value="old('database')" required />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-jet-button class="ml-4">
                    {{ __('Create') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
