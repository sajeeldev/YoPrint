<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-purple-50 to-blue-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden max-w-5xl w-full flex flex-col md:flex-row">

        <!-- Image Section -->
        <div
            class="w-full md:w-1/2 bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center p-12 order-2 md:order-1">
            <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
                alt="Office Illustration" class="max-w-full h-auto drop-shadow-2xl">
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-12 order-1 md:order-2">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Sign in</h2>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.login') }}">
                @csrf

                <!-- Username/Email Input -->
                <div class="mb-6 relative">
                    <i class="fas fa-user absolute left-4 top-4 text-gray-400"></i>
                    <input type="text" name="email" id="email" placeholder="John Doe"
                        value="{{ old('email') }}"
                        class="w-full pl-12 pr-4 py-3 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        required>
                    @error('email')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-6 relative">
                    <i class="fas fa-lock absolute left-4 top-4 text-gray-400"></i>
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="w-full pl-12 pr-4 py-3 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        required>
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-4 top-4 text-gray-400 hover:text-gray-600">
                        <i id="toggleIcon" class="fas fa-eye"></i>
                    </button>
                    @error('password')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me Checkbox -->
                <div class="mb-6 flex items-center">
                    <input type="checkbox" id="remember" name="remember"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600">
                        Remember me
                    </label>
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition duration-200 mb-6">
                    Log in
                </button>

                <!-- Social Login -->
                <div class="mb-6">
                    <p class="text-center text-sm text-gray-600 mb-4">Or login with</p>
                    <div class="flex justify-center gap-3">
                        <a href="#"
                            class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center transition duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-blue-400 hover:bg-blue-500 text-white rounded-lg flex items-center justify-center transition duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-red-500 hover:bg-red-600 text-white rounded-lg flex items-center justify-center transition duration-200">
                            <i class="fab fa-google"></i>
                        </a>
                    </div>
                </div>

                <!-- Create Account Link -->
                <p class="text-center text-sm text-gray-600">
                    <a href="{{ route('signUp') }}" class="text-blue-600 hover:underline cursor-pointer">Create
                        an account</a>
                </p>
            </form>
        </div>

    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>
