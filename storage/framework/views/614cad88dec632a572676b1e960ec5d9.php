<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>My Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        base: '#08050a',
                        primary: '#880808',
                        borderMuted: 'rgba(255, 255, 255, 0.06)',
                        surface: 'rgba(255, 255, 255, 0.02)',
                        surfaceHover: 'rgba(255, 255, 255, 0.04)',
                        textMuted: '#8a8a93'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            background-color: #08050a;
            color: #ffffff;
            -webkit-font-smoothing: antialiased;
        }

        .hero-pattern-bg {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='48' height='48' viewBox='0 0 48 48' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Crect x='0' y='0' width='20' height='20' rx='4'/%3E%3Crect x='24' y='24' width='20' height='20' rx='4'/%3E%3C/g%3E%3Cg stroke='%23ffffff' stroke-opacity='0.03' stroke-width='1'%3E%3Crect x='24' y='0' width='20' height='20' rx='4'/%3E%3Crect x='0' y='24' width='20' height='20' rx='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            background-size: 48px 48px;
            mask-image: radial-gradient(ellipse 100% 100% at 50% 0%, black 30%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse 100% 100% at 50% 0%, black 30%, transparent 80%);
            z-index: 0;
        }

        .hero-spotlight {
            position: absolute;
            top: -150px;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 600px;
            background: radial-gradient(circle, rgba(244, 63, 94, 0.15) 0%, rgba(8, 5, 10, 0) 70%);
            mix-blend-mode: screen;
            z-index: 0;
            pointer-events: none;
        }

        #navbar {
            transition: transform 0.45s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s;
        }

        .nav-hide {
            transform: translateY(-120%);
            opacity: 0;
        }

        .webgl-globe-outer {
            position: absolute;
            bottom: -200px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            height: 800px;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
            opacity: 0.6;
            mask-image: radial-gradient(circle at center, black 30%, transparent 70%);
            -webkit-mask-image: radial-gradient(circle at center, black 30%, transparent 70%);
        }

        .webgl-globe-container {
            width: 1000px;
            height: 1000px;
            margin: 0 auto;
            background: radial-gradient(circle at center, rgba(244, 63, 94, 0.15) 0%, transparent 65%);
        }

        canvas {
            width: 100%;
            height: 100%;
            outline: none;
        }

        .edu-svg-container {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.01);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #880808;
            border-radius: 10px;
        }
    </style>
</head>
<body class="relative overflow-x-hidden">

    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('partials.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/layouts/app.blade.php ENDPATH**/ ?>