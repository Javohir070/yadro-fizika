<x-guest-layout>
    <div class="w-full max-w-md mx-auto rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-semibold text-gray-900">{{ __('Create account') }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ __('Fill in the details to get started.') }}</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation"
                    class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="pt-2">
                <x-primary-button class="w-full justify-center">
                    {{ __('Register') }}
                </x-primary-button>
            </div>

            <p class="text-center text-sm text-gray-600">
                {{ __('Already registered?') }}
                <a class="font-medium text-indigo-600 hover:text-indigo-500" href="{{ route('login') }}">
                    {{ __('Sign in') }}
                </a>
            </p>
        </form>
    </div>
</x-guest-layout>
