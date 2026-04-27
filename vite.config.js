import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/metadata-form.css',
                'resources/js/bootstrap.js',
                'resources/js/app.js',
                'resources/js/dashboard.js',
                'resources/js/profile.js',
                'resources/js/pengalaman.js',
                'resources/js/sections/education.js',
                'resources/js/admin/edukasi/index.js',
                'resources/js/admin/technology/index.js',
                'resources/js/admin/technology/create.js',
                'resources/js/admin/technology/edit.js',
                'resources/js/admin/sertifikat/index.js',
                'resources/js/admin/sertifikat/create.js',
                'resources/js/admin/sertifikat/edit.js',
                'resources/js/admin/project/index.js',
                'resources/js/admin/project/create.js',
                'resources/js/admin/project/edit.js',
                'resources/js/admin/article/index.js',
                'resources/js/admin/article/create.js',
                'resources/js/admin/article/publish.js',
            ],
            refresh: true,
        }),
    ],
});
