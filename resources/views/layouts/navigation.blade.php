<nav class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-14 items-center">

            {{-- BRAND --}}
            <div class="font-bold text-indigo-600">
                <a href="{{ route('public.dashboard') }}">Kas Kontrakan</a>
            </div>

            {{-- DESKTOP MENU --}}
            <div class="hidden md:flex items-center space-x-6">

                {{-- PUBLIC --}}
                <a href="{{ route('public.dashboard') }}" class="hover:text-indigo-600">
                    Kas
                </a>

                {{-- ADMIN MENU --}}
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}">Admin</a>
                        <a href="{{ route('admin.users.index') }}">Approve User</a>
                        <a href="{{ route('admin.payments.index') }}">Tagihan</a>
                        <a href="{{ route('admin.installments.index') }}">Cicilan</a>
                        <a href="{{ route('admin.non-cash.index') }}">Non-Kas</a>
                        <a href="{{ route('categories.index') }}">Kategori</a>
                        <a href="{{ route('admin.expenses.index') }}">Pengeluaran</a>
                    @endif
                @endauth

                {{-- USER DROPDOWN --}}
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-500 hover:underline">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endauth
            </div>

            {{-- MOBILE TOGGLE --}}
            <button class="md:hidden" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                ☰
            </button>
        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div id="mobileMenu" class="hidden md:hidden px-4 pb-4 space-y-2">
        <a href="{{ route('public.dashboard') }}" class="block">Kas</a>

        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="block">Admin</a>
                <a href="{{ route('admin.users.index') }}" class="block">Approve User</a>
                <a href="{{ route('admin.payments.index') }}" class="block">Tagihan</a>
                <a href="{{ route('admin.installments.index') }}" class="block">Cicilan</a>
                <a href="{{ route('admin.non-cash.index') }}" class="block">Non-Kas</a>
                <a href="{{ route('categories.index') }}" class="block">Kategori</a>
                <a href="{{ route('admin.expenses.index') }}" class="block">Pengeluaran</a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block text-red-500">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </div>
</nav>
