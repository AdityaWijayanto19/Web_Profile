<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .bg-pink-main { background-color: #880808; }
        .text-pink-main { color: #880808; }

        .leaf-pattern {
            background-image: url('https://www.transparenttextures.com/patterns/leaf.png');
            opacity: 0.15;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-up { animation: slideUp 0.6s ease-out forwards; }
    </style>
</head>
<body class="h-screen w-full overflow-hidden bg-white">

    <div class="flex h-full w-full relative">

        <div class="relative hidden lg:flex lg:w-[55%] bg-pink-main flex-col justify-between p-16 overflow-hidden">
            <div class="absolute inset-0 leaf-pattern pointer-events-none"></div>
            <svg class="absolute top-0 -right-1 h-full w-32 z-10 fill-white" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 0 C 50 0, 50 100, 100 100 L 100 0 Z" />
            </svg>

            <div class="z-20 flex flex-col justify-between h-full">

                <div class="text-white space-y-6">
                    <h1 class="text-5xl font-bold leading-tight">Reset Password</h1>
                    <p class="text-lg text-white/80">Enter your email address to receive a password reset link.</p>
                </div>

                <div class="flex justify-center items-center py-8">
                    <img src="{{ asset('assets/images/Illustration-3.svg') }}"
                         alt="Admin Illustration"
                         class="w-96 mr-16 h-auto object-contain drop-shadow-xl opacity-95 hover:opacity-100 transition-opacity duration-300">
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[45%] h-full flex flex-col justify-center items-center px-8 md:px-20 bg-white">

            <div class="w-full max-w-md animate-up">
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">Reset Your Password</h2>
                    <p class="text-gray-500 mt-2">Enter your email address to receive a password reset link.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                        @foreach ($errors->all() as $error)
                            <p>• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-circle-xmark"></i>
                        {{ session('error') }}
                    </div>

                    @if (session('debug_error') && app()->environment('local'))
                        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-xl text-yellow-800 text-xs font-mono">
                            <p class="font-bold mb-2">🔧 Debug Info (Development Only):</p>
                            <p class="break-words">{{ session('debug_error') }}</p>
                        </div>
                    @endif
                @endif

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-circle-check text-green-600 mt-1"></i>
                            <div>
                                <p class="text-green-700 font-bold text-sm mb-3">Password Reset Link Sent</p>
                                <p class="text-green-600 text-sm leading-relaxed mb-3">
                                    We've sent a password reset link to <strong>{{ request('email', 'your email') }}</strong>.
                                    Please check your inbox (and spam folder, just in case) within the next hour to reset your password.
                                </p>
                                <p class="text-green-600 text-xs leading-relaxed">
                                    The reset link will expire in 60 minutes for your security. If you didn't request this, you can safely ignore this email.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                        <p class="text-blue-700 font-bold text-sm mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-info-circle"></i>
                            Next Steps
                        </p>
                        <ol class="text-blue-600 text-sm space-y-1 ml-6">
                            <li>1. Open the email we just sent to you</li>
                            <li>2. Click the "Reset Your Password" button</li>
                            <li>3. Enter your new password</li>
                            <li>4. Log in with your new password</li>
                        </ol>
                    </div>

                    <div class="text-center">
                        <p class="text-gray-600 text-sm mb-2">Didn't receive the email?</p>
                        <button type="button" onclick="document.querySelector('form').reset()" class="text-pink-main hover:underline text-xs font-bold">
                            Try another email address
                        </button>
                    </div>
                @else
                    <form action="{{ route('password.send-reset') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-pink-50 focus:border-pink-main outline-none transition-all duration-300"
                                placeholder="admin@example.com">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-pink-main text-white font-bold py-4 rounded-2xl shadow-xl shadow-pink-200 hover:bg-[#ca0000] hover:-translate-y-1 transition-all duration-300 uppercase tracking-widest text-sm flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i>
                        Send Reset Link
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-gray-500 text-sm">
                        Remember your password?
                        <a href="{{ route('login') }}" class="font-bold text-pink-main hover:underline">Back to Login</a>
                    </p>
                </div>
                @endif
            </div>
        </div>

    </div>
</body>
</html>
