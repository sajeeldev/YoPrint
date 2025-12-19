<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-purple-50 to-blue-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden max-w-5xl w-full flex flex-col md:flex-row">

        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Sign up</h2>

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
                    <strong class="font-semibold">Please fix the following errors:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.register') }}">
                @csrf

                <!-- Name Input -->
                <div class="mb-6 relative">
                    <i class="fas fa-user absolute left-4 top-4 text-gray-400"></i>
                    <input type="text" name="name" id="name" placeholder="John Doe"
                        value="{{ old('name') }}"
                        class="w-full pl-12 pr-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent @error('name') border-red-500 ring-1 ring-red-300 @enderror"
                        required>
                    @error('name')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="mb-6 relative">
                    <i class="fas fa-envelope absolute left-4 top-4 text-gray-400"></i>
                    <input type="email" name="email" id="email" placeholder="Your Email"
                        value="{{ old('email') }}"
                        class="w-full pl-12 pr-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent @error('email') border-red-500 ring-1 ring-red-300 @enderror"
                        required>
                    @error('email')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-6 relative">
                    <i class="fas fa-lock absolute left-4 top-4 text-gray-400"></i>
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="w-full pl-12 pr-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent @error('password') border-red-500 ring-1 ring-red-300 @enderror"
                        required>
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-4 top-4 text-gray-400 hover:text-gray-600">
                        <i id="toggleIcon" class="fas fa-eye"></i>
                    </button>
                    @error('password')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Repeat Password Input -->
                <div class="mb-6 relative">
                    <i class="fas fa-lock absolute left-4 top-4 text-gray-400"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Repeat your password"
                        class="w-full pl-12 pr-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        required>
                    <button type="button" onclick="togglePasswordConfirmation()"
                        class="absolute right-4 top-4 text-gray-400 hover:text-gray-600">
                        <i id="toggleIcon2" class="fas fa-eye"></i>
                    </button>
                </div>

                <!-- Terms Checkbox -->
                <div class="mb-6 flex items-center">
                    <input type="checkbox" id="terms" name="terms"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        @if(old('terms')) checked @endif required>
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        I agree all statements in <a href="#" class="text-blue-600 hover:underline">Terms of
                            service</a>
                    </label>
                </div>

                <!-- Register Button -->
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition duration-200 mb-6">
                    Register
                </button>

                <!-- Login Link -->
                <p class="text-center text-sm text-gray-600">
                    <a href="{{ route('user.signIn') }}" class="text-blue-600 hover:underline cursor-pointer">I am already
                        member</a>
                </p>
            </form>
        </div>

        <!-- Image Section -->
        <div class="w-full md:w-1/2 bg-gradient-to-br from-pink-50 to-purple-50 flex items-center justify-center p-12">
            <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
                alt="Office Setup Illustration" class="max-w-full h-auto drop-shadow-2xl">
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

        function togglePasswordConfirmation() {
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const toggleIcon2 = document.getElementById('toggleIcon2');

            if (passwordConfirmationInput.type === 'password') {
                passwordConfirmationInput.type = 'text';
                toggleIcon2.classList.remove('fa-eye');
                toggleIcon2.classList.add('fa-eye-slash');
            } else {
                passwordConfirmationInput.type = 'password';
                toggleIcon2.classList.remove('fa-eye-slash');
                toggleIcon2.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>
