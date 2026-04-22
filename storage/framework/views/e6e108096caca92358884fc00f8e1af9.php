<?php $__env->startSection('title', 'Admin Login'); ?>
<?php $__env->startSection('side_title', 'Web Profile Admin'); ?>
<?php $__env->startSection('side_description', 'Manage your portfolio and professional content.'); ?>

<?php $__env->startSection('content'); ?>
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

    <?php echo $__env->make('components.auth-alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <form action="<?php echo e(route('login.submit')); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>
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
        </div>

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
        </div>

        <div class="flex items-center">
            <input type="checkbox" id="remember" name="remember" value="1" class="w-4 h-4 rounded border-gray-300 text-pink-main focus:ring-pink-main focus:ring-2 accent-pink-main">
            <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
        </div>

        <button type="submit" class="w-full bg-pink-main text-white font-bold py-4 rounded-2xl shadow-xl shadow-pink-200 hover:bg-[#ca0000] hover:-translate-y-1 transition-all duration-300 uppercase tracking-widest text-sm flex items-center justify-center gap-2">
            <i class="fa-solid fa-sign-in-alt"></i> Sign In Now
        </button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', ['illustration' => 'Illustration-2.svg'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/auth/login.blade.php ENDPATH**/ ?>