<x-guest-layout>

    {{-- STATUS (reset password dll) --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- ERROR INACTIVE --}}
    @if (session('error'))
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- EMAIL --}}
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- PASSWORD --}}
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- REMEMBER --}}
        <div class="block mt-4">
            <label class="inline-flex items-center">
                <input
                    type="checkbox"
                    name="remember"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                >
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        {{-- ACTION --}}
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                    href="{{ route('password.request') }}"
                >
                    Forgot your password?
                </a>
            @endif

            <x-primary-button class="ms-3">
                Log in
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
