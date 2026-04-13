<?php

namespace Database\Seeders;

use App\Models\Teknologi;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            // Backend & Languages
            ['nama' => 'Laravel', 'path_icon' => 'laravel'],
            ['nama' => 'PHP', 'path_icon' => 'php'],
            ['nama' => 'Python', 'path_icon' => 'python'],
            ['nama' => 'Node.js', 'path_icon' => 'nodejs'],
            ['nama' => 'Java', 'path_icon' => 'java'],
            ['nama' => 'C#', 'path_icon' => 'csharp'],
            ['nama' => 'Go', 'path_icon' => 'go'],
            ['nama' => 'Rust', 'path_icon' => 'rust'],

            // Frontend & UI
            ['nama' => 'React', 'path_icon' => 'react'],
            ['nama' => 'Vue.js', 'path_icon' => 'vue'],
            ['nama' => 'Angular', 'path_icon' => 'angular'],
            ['nama' => 'Svelte', 'path_icon' => 'svelte'],
            ['nama' => 'JavaScript', 'path_icon' => 'javascript'],
            ['nama' => 'TypeScript', 'path_icon' => 'typescript'],
            ['nama' => 'Tailwind CSS', 'path_icon' => 'tailwindcss'],
            ['nama' => 'Bootstrap', 'path_icon' => 'bootstrap'],
            ['nama' => 'HTML5', 'path_icon' => 'html5'],
            ['nama' => 'CSS3', 'path_icon' => 'css3'],
            ['nama' => 'SASS', 'path_icon' => 'sass'],

            // Databases
            ['nama' => 'MySQL', 'path_icon' => 'mysql'],
            ['nama' => 'PostgreSQL', 'path_icon' => 'postgresql'],
            ['nama' => 'MongoDB', 'path_icon' => 'mongodb'],
            ['nama' => 'Firebase', 'path_icon' => 'firebase'],
            ['nama' => 'Redis', 'path_icon' => 'redis'],
            ['nama' => 'SQLite', 'path_icon' => 'sqlite'],
            ['nama' => 'Elasticsearch', 'path_icon' => 'elasticsearch'],

            // DevOps & Tools
            ['nama' => 'Docker', 'path_icon' => 'docker'],
            ['nama' => 'Kubernetes', 'path_icon' => 'kubernetes'],
            ['nama' => 'Git', 'path_icon' => 'git'],
            ['nama' => 'GitHub', 'path_icon' => 'github'],
            ['nama' => 'GitLab', 'path_icon' => 'gitlab'],
            ['nama' => 'AWS', 'path_icon' => 'amazonaws'],
            ['nama' => 'Azure', 'path_icon' => 'azure'],
            ['nama' => 'Google Cloud', 'path_icon' => 'googlecloud'],
            ['nama' => 'Vercel', 'path_icon' => 'vercel'],
            ['nama' => 'Netlify', 'path_icon' => 'netlify'],
            ['nama' => 'Linux', 'path_icon' => 'linux'],
            ['nama' => 'Ubuntu', 'path_icon' => 'ubuntu'],

            // Build & Package Tools
            ['nama' => 'NPM', 'path_icon' => 'npm'],
            ['nama' => 'Yarn', 'path_icon' => 'yarn'],
            ['nama' => 'Webpack', 'path_icon' => 'webpack'],
            ['nama' => 'Vite', 'path_icon' => 'vite'],

            // Testing & Quality
            ['nama' => 'Jest', 'path_icon' => 'jest'],
            ['nama' => 'Cypress', 'path_icon' => 'cypress'],
            ['nama' => 'Postman', 'path_icon' => 'postman'],

            // Design & Tools
            ['nama' => 'Figma', 'path_icon' => 'figma'],
            ['nama' => 'VS Code', 'path_icon' => 'visualstudiocode'],

            // APIs & Real-time
            ['nama' => 'GraphQL', 'path_icon' => 'graphql'],
            ['nama' => 'Socket.IO', 'path_icon' => 'socketio'],

            // Message Queue
            ['nama' => 'RabbitMQ', 'path_icon' => 'rabbitmq'],
            ['nama' => 'Kafka', 'path_icon' => 'apache-kafka'],
        ];

        foreach ($technologies as $tech) {
            Teknologi::firstOrCreate(
                ['nama' => $tech['nama']],
                ['path_icon' => $tech['path_icon']]
            );
        }
    }
}
