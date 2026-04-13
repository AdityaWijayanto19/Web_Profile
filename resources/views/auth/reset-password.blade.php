<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Admin Portal</title>
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

        <!-- ================= PANEL KIRI (VISUAL) ================= -->
        <div class="relative hidden lg:flex lg:w-[55%] bg-pink-main flex-col justify-between p-16 overflow-hidden">
            <div class="absolute inset-0 leaf-pattern pointer-events-none"></div>
            <svg class="absolute top-0 -right-1 h-full w-32 z-10 fill-white" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 0 C 50 0, 50 100, 100 100 L 100 0 Z" />
            </svg>
        </div>

        <!-- ================= PANEL KANAN (FORM) ================= -->
        <div class="w-full lg:w-[45%] h-full flex flex-col justify-center items-center px-8 md:px-20 bg-white">

            <div class="w-full max-w-md animate-up">
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">Reset Password</h2>
                    <p class="text-gray-500 mt-2">Create a new password for your account.</p>
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
                @endif

                <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Email (Hidden) -->
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- New Password -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">New Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" id="password" name="password" required
                                class="w-full pl-12 pr-12 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-pink-50 focus:border-pink-main outline-none transition-all duration-300"
                                placeholder="••••••••">
                            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-pink-main toggle-password" data-target="password">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Confirm Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full pl-12 pr-12 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-pink-50 focus:border-pink-main outline-none transition-all duration-300"
                                placeholder="••••••••">
                            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-pink-main toggle-password" data-target="password_confirmation">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full bg-pink-main text-white font-bold py-4 rounded-2xl shadow-xl shadow-pink-200 hover:bg-[#ca0000] hover:-translate-y-1 transition-all duration-300 uppercase tracking-widest text-sm">
                        Reset Password
                    </button>
                </form>

                <!-- Back to Login -->
                <div class="mt-8 text-center">
                    <p class="text-gray-500 text-sm">
                        <a href="{{ route('login') }}" class="font-bold text-pink-main hover:underline">Back to Login</a>
                    </p>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>
