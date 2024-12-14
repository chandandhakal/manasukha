<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side -->
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-indigo-600">
                        ManaSukha
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:ml-10 sm:space-x-8">

                    @auth
                        @if(auth()->user()->hasRole('therapist'))
                            <a href="{{ route('therapist.appointments.index') }}" 
                               class="inline-flex items-center px-1 pt-1 {{ request()->routeIs('therapist.appointments.index') ? 'border-b-2 border-indigo-400 text-gray-900' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                My Appointments
                            </a>
                        @else
                            <a href="{{ route('appointments.index') }}" 
                               class="inline-flex items-center px-1 pt-1 {{ request()->routeIs('appointments.index') ? 'border-b-2 border-indigo-400 text-gray-900' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                My Bookings
                            </a>
                            <a href="{{ route('therapists.index') }}" 
                               class="ml-8 inline-flex items-center px-1 pt-1 {{ request()->routeIs('therapists.index') ? 'border-b-2 border-indigo-400 text-gray-900' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                               style="margin-left: 2rem;">
                                Find Therapist
                            </a>

                            <a href="{{ route('assessment.index') }}" 
                               class="ml-8 inline-flex items-center px-1 pt-1 {{ request()->routeIs('therapists.index') ? 'border-b-2 border-indigo-400 text-gray-900' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                               style="margin-left: 2rem;">
                                Take Assessment
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center">
                <div class="relative">
                    <!-- Profile Dropdown -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <span class="text-gray-700">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-gray-700">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700">Login</a>
                            <a href="{{ route('signup') }}" class="text-gray-500 hover:text-gray-700">Register</a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button onclick="toggleMobileMenu()" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobileMenu" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" 
               class="block pl-3 pr-4 py-2 {{ request()->routeIs('dashboard') ? 'bg-indigo-50 border-l-4 border-indigo-400 text-indigo-700' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                Dashboard
            </a>

            @auth
                @if(auth()->user()->hasRole('therapist'))
                    <a href="{{ route('therapist.appointments.index') }}" 
                       class="block pl-3 pr-4 py-2 {{ request()->routeIs('therapist.appointments.index') ? 'bg-indigo-50 border-l-4 border-indigo-400 text-indigo-700' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                        My Appointments
                    </a>
                @else
                    <a href="{{ route('appointments.index') }}" 
                       class="block pl-3 pr-4 py-2 {{ request()->routeIs('appointments.index') ? 'bg-indigo-50 border-l-4 border-indigo-400 text-indigo-700' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                        My Bookings
                    </a>
                    <a href="{{ route('therapists.index') }}" 
                       class="block pl-3 pr-4 py-2 {{ request()->routeIs('therapists.index') ? 'bg-indigo-50 border-l-4 border-indigo-400 text-indigo-700' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                        Find Therapist
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                    Login
                </a>
                <a href="{{ route('signup') }}" class="block pl-3 pr-4 py-2 text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                    Register
                </a>
            @endauth

            <div class="pt-4 pb-3 border-t border-gray-200">
                @auth
                    <div class="px-4">
                        <div class="text-base font-medium text-gray-800">{{ auth()->user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                    <div class="mt-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('hidden');
}
</script> 