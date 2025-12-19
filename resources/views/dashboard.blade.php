<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Hire Nest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">

    <!-- Sidebar -->
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white flex-shrink-0">
            <div class="p-6">
                <h2 class="text-2xl font-bold">Hire Nest</h2>
                <p class="text-blue-200 text-sm">Dashboard</p>
            </div>

            <nav class="mt-6">
                <a href="#" class="flex items-center px-6 py-3 bg-blue-700 bg-opacity-50 border-l-4 border-white">
                    <i class="fas fa-home w-6"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 hover:bg-opacity-50 transition duration-200">
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
                </a>
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

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Header -->
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
                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=4F46E5&color=fff"
                                 alt="Profile"
                                 class="w-10 h-10 rounded-full">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">John Doe</p>
                                <p class="text-xs text-gray-500">john@example.com</p>
                            </div>
                        </div>

                        <!-- Logout Button (Header) -->
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition duration-200">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-8">

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Total Applications</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">24</h3>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-full">
                                <i class="fas fa-file-alt text-2xl text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Interviews</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">8</h3>
                            </div>
                            <div class="bg-green-100 p-4 rounded-full">
                                <i class="fas fa-calendar-check text-2xl text-green-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Pending</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">12</h3>
                            </div>
                            <div class="bg-yellow-100 p-4 rounded-full">
                                <i class="fas fa-clock text-2xl text-yellow-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Offers</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">3</h3>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-full">
                                <i class="fas fa-trophy text-2xl text-purple-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- File Upload Section -->
                <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Upload Your Resume</h2>
                        <p class="text-gray-600 text-sm">Upload your resume or CV to apply for jobs quickly</p>
                    </div>

                    <form action="{{ route('upload.resume') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-12 text-center hover:border-blue-500 transition duration-200 cursor-pointer relative">
                            <input type="file"
                                   name="resume"
                                   id="fileInput"
                                   accept=".pdf,.doc,.docx"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                   onchange="displayFileName(this)">

                            <div class="flex flex-col items-center">
                                <div class="bg-blue-100 p-6 rounded-full mb-4">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-blue-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Drop your file here or click to browse</h3>
                                <p class="text-gray-500 text-sm mb-4">Supported formats: PDF, DOC, DOCX (Max 5MB)</p>
                                <p id="fileName" class="text-blue-600 font-medium"></p>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                    class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg shadow-lg transform transition-all duration-200 hover:scale-105">
                                <i class="fas fa-upload mr-2"></i>Upload Resume
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Recent Applications -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Recent Applications</h2>
                        <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    <i class="fas fa-briefcase text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Senior Software Engineer</h4>
                                    <p class="text-sm text-gray-500">Google Inc. • San Francisco, CA</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">Pending</span>
                                <p class="text-xs text-gray-500 mt-1">Applied 2 days ago</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                            <div class="flex items-center space-x-4">
                                <div class="bg-green-100 p-3 rounded-lg">
                                    <i class="fas fa-briefcase text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Full Stack Developer</h4>
                                    <p class="text-sm text-gray-500">Microsoft • Seattle, WA</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Interview</span>
                                <p class="text-xs text-gray-500 mt-1">Applied 5 days ago</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                            <div class="flex items-center space-x-4">
                                <div class="bg-purple-100 p-3 rounded-lg">
                                    <i class="fas fa-briefcase text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Product Manager</h4>
                                    <p class="text-sm text-gray-500">Apple Inc. • Cupertino, CA</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-medium">Offer</span>
                                <p class="text-xs text-gray-500 mt-1">Applied 1 week ago</p>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        function displayFileName(input) {
            const fileName = input.files[0]?.name;
            if (fileName) {
                document.getElementById('fileName').textContent = `Selected: ${fileName}`;
            }
        }
    </script>

</body>
</html>
