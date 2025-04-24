<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left Section -->
        <div class="w-full md:w-1/3 bg-amber-400 flex items-center justify-center order-2 md:order-1">
            <div class="text-center p-8">
                <h2 class="text-3xl font-bold text-white mb-6">Selamat Datang Kembali!</h2>
                <p class="text-white mb-8">Agar tetap terhubung dengan kami, silakan login dengan info pribadimu!</p>
                <a href="/sign-in" class="px-8 py-3 bg-transparent border-2 border-white text-white 
                          rounded-full hover:bg-white hover:text-amber-400 transition duration-300">
                    Sign In
                </a>
            </div>
        </div>

        <!-- Right Section (Sign Up Form) -->
        <div class="w-full md:w-2/3 bg-white flex items-center justify-center order-1 md:order-2">
            <div class="max-w-md w-full px-8 py-12">
                <!-- Title -->
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Buat Akun Anda</h2>

                <!-- Social Sign Up -->
                <div class="mb-8">
                    <p class="text-gray-600 mb-4">Buat menggunakan akun:</p>
                    <button class="w-full flex items-center justify-center gap-2 bg-gray-100 text-gray-700 py-3 rounded-lg 
                              shadow-md hover:shadow-lg transition duration-300">
                        <svg class="w-5 h-5" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M47.532 24.5528C47.532 22.9214 47.3997 21.2811 47.1175 19.6761H24.48V28.9181H37.4434C36.9055 31.8988 35.177 34.5356 32.6461 36.2111V42.2078H40.3801C44.9217 38.0278 47.532 31.8547 47.532 24.5528Z" fill="#4285F4"/>
                            <path d="M24.48 48.0016C30.9529 48.0016 36.4116 45.8764 40.3888 42.2078L32.6549 36.2111C30.5031 37.675 27.7252 38.5039 24.4888 38.5039C18.2276 38.5039 12.9187 34.2798 11.0139 28.6006H3.03296V34.7825C7.10718 42.8868 15.4056 48.0016 24.48 48.0016Z" fill="#34A853"/>
                            <path d="M11.0051 28.6006C9.99973 25.6199 9.99973 22.3922 11.0051 19.4115V13.2296H3.03298C-0.371021 20.0112 -0.371021 28.0009 3.03298 34.7825L11.0051 28.6006Z" fill="#FBBC04"/>
                            <path d="M24.48 9.49932C27.9016 9.44641 31.2086 10.7339 33.6866 13.0973L40.5387 6.24523C36.2 2.17101 30.4414 -0.068932 24.48 0.00161733C15.4056 0.00161733 7.10718 5.11644 3.03296 13.2296L11.005 19.4115C12.901 13.7235 18.2187 9.49932 24.48 9.49932Z" fill="#EA4335"/>
                        </svg>
                        Sign up with Google
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative flex items-center mb-8">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="flex-shrink mx-4 text-gray-500">or</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <!-- Sign Up Form -->
                <form class="space-y-6">
                    <div>
                        <input type="text" placeholder="Name" class="w-full px-4 py-3 bg-gray-50 rounded-lg shadow-sm 
                                  focus:outline-none focus:ring-2 focus:ring-amber-400">
                    </div>

                    <div>
                        <input type="text" placeholder="Username" class="w-full px-4 py-3 bg-gray-50 rounded-lg shadow-sm 
                                  focus:outline-none focus:ring-2 focus:ring-amber-400">
                    </div>

                    <div>
                        <input type="email" placeholder="Email" class="w-full px-4 py-3 bg-gray-50 rounded-lg shadow-sm 
                                  focus:outline-none focus:ring-2 focus:ring-amber-400">
                    </div>
                    
                    <div>
                        <input type="password" placeholder="Password" class="w-full px-4 py-3 bg-gray-50 rounded-lg shadow-sm 
                                  focus:outline-none focus:ring-2 focus:ring-amber-400">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" class="w-4 h-4 text-amber-400 focus:ring-amber-400">
                        <span class="ml-2 text-gray-600">
                            I have read the 
                            <a href="#" class="text-amber-400 hover:underline">Terms & Conditions</a>
                        </span>
                    </div>

                    <button class="w-full bg-amber-400 text-white py-3 rounded-lg shadow-md hover:bg-amber-600 
                              transition duration-300">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>