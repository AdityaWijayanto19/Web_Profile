<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Web Profile</title>
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

            <!-- Content wrapper with flexible centering -->
            <div class="z-20 flex flex-col justify-between h-full">
                <!-- Top text -->
                <div class="text-white space-y-6">
                    <h1 class="text-5xl font-bold leading-tight">Web Profile Admin</h1>
                    <p class="text-lg text-white/80">Manage your portfolio and professional content.</p>
                </div>

                <!-- Center illustration -->
                <div class="flex justify-center items-center py-8">
                    <img src="<?php echo e(asset('assets/images/Illustration-2.svg')); ?>"
                         alt="Admin Illustration"
                         class="w-96 mr-16 h-auto object-contain drop-shadow-xl opacity-95 hover:opacity-100 transition-opacity duration-300">
                </div>
            </div>
        </div>

        <!-- ================= PANEL KANAN (FORM) ================= -->
        <div class="w-full lg:w-[45%] h-full flex flex-col justify-center items-center px-8 md:px-20 bg-white">

            <div class="w-full max-w-md animate-up">
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">Login</h2>
                    <p class="text-gray-500 mt-2">Sign in to access your admin dashboard.</p>
                </div>

                <?php if($errors->any()): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p>• <?php echo e($error); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-circle-xmark"></i>
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('success')): ?>
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-circle-check"></i>
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('login.submit')); ?>" method="POST" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" name="email" required value="<?php echo e(old('email')); ?>"
                                class="w-full pl-12 pr-4 py-4 bg-gray-50 border <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php else: ?> border-gray-100 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> rounded-2xl focus:ring-4 focus:ring-pink-50 focus:border-pink-main outline-none transition-all duration-300"
                                placeholder="admin@example.com">
                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-xs text-red-500 ml-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Password</label>
                            <a href="<?php echo e(route('password.forgot')); ?>" class="text-xs font-bold text-pink-main hover:underline">Forgot?</a>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" id="password" name="password" required
                                class="w-full pl-12 pr-12 py-4 bg-gray-50 border <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php else: ?> border-gray-100 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> rounded-2xl focus:ring-4 focus:ring-pink-50 focus:border-pink-main outline-none transition-all duration-300"
                                placeholder="••••••••">
                            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-pink-main toggle-password" data-target="password">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-xs text-red-500 ml-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" value="1"
                            class="w-4 h-4 rounded border-gray-300 text-pink-main focus:ring-pink-main focus:ring-2 accent-pink-main">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full bg-pink-main text-white font-bold py-4 rounded-2xl shadow-xl shadow-pink-200 hover:bg-[#ca0000] hover:-translate-y-1 transition-all duration-300 uppercase tracking-widest text-sm flex items-center justify-center gap-2">
                        <i class="fa-solid fa-sign-in-alt"></i>
                        Sign In Now
                    </button>
                </form>
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
<?php /**PATH C:\laragon\www\Web Profile\resources\views/auth/login.blade.php ENDPATH**/ ?>