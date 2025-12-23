<header class="bg-white shadow-sm z-10">
    <div class="flex items-center justify-between px-8 py-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Welcome Back, John!</h1>
            <p class="text-gray-600 text-sm">Here's what's happening with your job search today</p>
        </div>
        <div class="flex items-center space-x-4">
            <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-full transition duration-200">
                <i class="fas fa-bell text-xl"></i>
                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            <div class="flex items-center space-x-3">
                <img src="https://ui-avatars.com/api/?name=John+Doe&background=4F46E5&color=fff" alt="Profile"
                    class="w-10 h-10 rounded-full">
                <div>
                    <p class="text-sm font-semibold text-gray-800">John Doe</p>
                    <p class="text-xs text-gray-500">john@example.com</p>
                </div>
            </div>

            <!-- Logout Button (Header) -->
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition duration-200">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>
