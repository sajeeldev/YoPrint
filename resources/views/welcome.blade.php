<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('csv.png') }}" type="image/x-icon">
    <title>Welcome - Yo Print</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="h-screen overflow-hidden">

    <!-- Background Image Container -->
    <div class="relative h-screen w-full bg-cover bg-center bg-no-repeat"
         style="background-image: url('https://images.pexels.com/photos/633409/pexels-photo-633409.jpeg');">

        <!-- Overlay for better contrast -->
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>

        <!-- Content Container -->
        <div class="relative h-full flex items-center justify-center px-4">

            <!-- Glassmorphism Card -->
            <div class="w-full max-w-2xl backdrop-blur-xl bg-white bg-opacity-10 rounded-3xl shadow-2xl border border-white border-opacity-20 p-12 transform transition-all duration-500 hover:scale-105">

                <!-- Welcome Text -->
                <div class="text-center mb-10">
                    <h1 class="text-5xl md:text-6xl font-bold text-white mb-4 tracking-tight">
                        Welcome to <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">Yo Print</span>
                    </h1>
                    <p class="text-white text-opacity-90 text-lg md:text-xl">
                        Upload your CSV and watch YoPrint process it with ease
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('signUp') }}"
                       class="w-full sm:w-auto px-10 py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-xl shadow-lg transform transition-all duration-200 hover:scale-105 hover:shadow-xl text-center">
                        Register
                    </a>
                    <a href="{{ route('login') }}"
                       class="w-full sm:w-auto px-10 py-4 bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm text-white font-semibold rounded-xl border-2 border-white border-opacity-50 shadow-lg transform transition-all duration-200 hover:scale-105 hover:shadow-xl text-center">
                        Login
                    </a>
                </div>

                <!-- Footer -->
                <div class="mt-12 text-center">
                    <p class="text-white text-opacity-70 text-sm">
                        <i class="fas fa-heart text-red-400"></i> Made with love by SajeelurRehman
                    </p>
                </div>
            </div>

        </div>

    </div>

</body>
</html>
