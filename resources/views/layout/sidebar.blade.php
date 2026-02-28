
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white flex-shrink-0">
            <div class="p-6">
                <h2 class="text-2xl font-bold">Yo Print</h2>
                <p class="text-blue-200 text-sm">Dashboard</p>
            </div>

            <nav class="mt-6">
                <a href="#" class="flex items-center px-6 py-3 bg-blue-700 bg-opacity-50 border-l-4 border-white">
                    <i class="fas fa-home w-6"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                {{-- <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 hover:bg-opacity-50 transition duration-200">
                    <i class="fas fa-briefcase w-6"></i>
                    <span class="ml-3">Jobs</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 hover:bg-opacity-50 transition duration-200">
                    <i class="fas fa-file-alt w-6"></i>
                    <span class="ml-3">Applications</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 hover:bg-opacity-50 transition duration-200">
                    <i class="fas fa-user w-6"></i>
                    <span class="ml-3">Profile</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 hover:bg-opacity-50 transition duration-200">
                    <i class="fas fa-cog w-6"></i>
                    <span class="ml-3">Settings</span>
                </a> --}}
            </nav>

            <div class="absolute bottom-0 w-64 p-6">
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-6 py-3 hover:bg-blue-700 hover:bg-opacity-50 rounded-lg transition duration-200 text-left">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span class="ml-3">Logout</span>
                    </button>
                </form>
            </div>
        </aside>