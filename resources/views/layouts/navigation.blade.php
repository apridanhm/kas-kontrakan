<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        {{-- LOGO --}}
        <div class="flex items-center space-x-4">
            <a href="{{ route('public.dashboard') }}" class="font-bold text-lg">
                KasKontrakan
            </a>

            {{-- MENU UMUM --}}
            <a href="{{ route('public.dashboard') }}"
               class="text-gray-700 hover:text-blue-600">
                Kas
            </a>

            {{-- ADMIN MENU --}}
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}"
                       class="text-gray-700 hover:text-blue-600">
                        Approve User
                    </a>

                    <a href="{{ route('admin.dashboard') }}"
                       class="text-gray-700 hover:text-blue-600">
                        Admin Panel
                    </a>
                @endif
            @endauth
        </div>

        {{-- RIGHT --}}
        <div class="flex items-center space-x-4">

            {{-- GUEST --}}
            @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">
                    Login
                </a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">
                    Register
                </a>
            @endguest

            {{-- AUTH --}}
            @auth
                <span class="text-gray-600 text-sm">
                    {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-600 hover:underline">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
