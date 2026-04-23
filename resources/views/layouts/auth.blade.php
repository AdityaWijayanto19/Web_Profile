<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>@yield('title')</title>
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
                    <h1 class="text-5xl font-bold leading-tight">@yield('side_title')</h1>
                    <p class="text-lg text-white/80">@yield('side_description')</p>
                </div>

                <div class="flex justify-center items-center py-8">
                    <img src="{{ asset('assets/images/' . $illustration) }}"
                         alt="Admin Illustration"
                         class="w-96 mr-16 h-auto object-contain drop-shadow-xl opacity-95 hover:opacity-100 transition-opacity duration-300">
                </div>
            </div>
        </div>
        
        <div class="w-full lg:w-[45%] h-full flex flex-col justify-center items-center px-8 md:px-20 bg-white">
            <div class="w-full max-w-md animate-up">
                @yield('content')
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
