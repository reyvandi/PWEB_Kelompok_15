<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Getting Started with Laravel',
                'slug' => 'getting-started-with-laravel',
                'excerpt' => 'Learn the basics of Laravel framework and how to build your first web application.',
                'content' => 'Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects...',
                'category' => 'Tutorial',
                'type' => 'article',
                'read_time' => 5,
                'duration' => '5 minutes',
                'thumbnail' => 'laravel-tutorial.jpg',
                'video_url' => null,
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
            ],
            [
                'title' => 'Advanced PHP Techniques',
                'slug' => 'advanced-php-techniques',
                'excerpt' => 'Explore advanced PHP programming techniques to improve your code quality and performance.',
                'content' => 'PHP has evolved significantly over the years. Modern PHP offers many advanced features that can help you write better, more maintainable code. In this article, we will explore some of these advanced techniques...',
                'category' => 'Programming',
                'type' => 'article',
                'read_time' => 8,
                'duration' => '8 minutes',
                'thumbnail' => 'php-advanced.jpg',
                'video_url' => null,
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(25),
            ],
            [
                'title' => 'Database Design Best Practices',
                'slug' => 'database-design-best-practices',
                'excerpt' => 'Learn essential database design principles for building scalable applications.',
                'content' => 'Good database design is crucial for building scalable and maintainable applications. This article covers the fundamental principles of database design, normalization, and optimization techniques...',
                'category' => 'Database',
                'type' => 'article',
                'read_time' => 12,
                'duration' => '12 minutes',
                'thumbnail' => 'database-design.jpg',
                'video_url' => null,
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(20),
            ],
            [
                'title' => 'JavaScript ES6+ Features',
                'slug' => 'javascript-es6-features',
                'excerpt' => 'Discover modern JavaScript features that will make your code more efficient and readable.',
                'content' => 'ECMAScript 6 (ES6) and later versions have introduced many powerful features to JavaScript. These features help developers write more concise, readable, and maintainable code...',
                'category' => 'JavaScript',
                'type' => 'article',
                'read_time' => 10,
                'duration' => '10 minutes',
                'thumbnail' => 'javascript-es6.jpg',
                'video_url' => null,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'title' => 'Introduction to Vue.js',
                'slug' => 'introduction-to-vuejs',
                'excerpt' => 'Get started with Vue.js, the progressive JavaScript framework for building user interfaces.',
                'content' => 'Vue.js is a progressive framework for building user interfaces. Unlike other monolithic frameworks, Vue is designed from the ground up to be incrementally adoptable...',
                'category' => 'Frontend',
                'type' => 'article',
                'read_time' => 7,
                'duration' => '7 minutes',
                'thumbnail' => 'vuejs-intro.jpg',
                'video_url' => 'https://youtube.com/watch?v=example1',
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => 'API Development with Laravel',
                'slug' => 'api-development-with-laravel',
                'excerpt' => 'Build robust RESTful APIs using Laravel framework with proper authentication and validation.',
                'content' => 'Building APIs is a common requirement in modern web development. Laravel provides excellent tools for creating RESTful APIs with features like resource controllers, API resources, and authentication...',
                'category' => 'API',
                'type' => 'article',
                'read_time' => 15,
                'duration' => '15 minutes',
                'thumbnail' => 'laravel-api.jpg',
                'video_url' => null,
                'created_at' => Carbon::now()->subDays(8),
                'updated_at' => Carbon::now()->subDays(8),
            ],
            [
                'title' => 'CSS Grid vs Flexbox',
                'slug' => 'css-grid-vs-flexbox',
                'excerpt' => 'Understanding when to use CSS Grid and when to use Flexbox for your layouts.',
                'content' => 'CSS Grid and Flexbox are both powerful layout systems in CSS. While they can sometimes be used to achieve similar results, they each have their strengths and ideal use cases...',
                'category' => 'CSS',
                'type' => 'article',
                'read_time' => 6,
                'duration' => '6 minutes',
                'thumbnail' => 'css-grid-flexbox.jpg',
                'video_url' => 'https://youtube.com/watch?v=example2',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Git Workflow Best Practices',
                'slug' => 'git-workflow-best-practices',
                'excerpt' => 'Learn effective Git workflows for team collaboration and version control.',
                'content' => 'Git is an essential tool for modern development. Understanding proper Git workflows can significantly improve team collaboration and code management. This article covers various Git workflows...',
                'category' => 'Tools',
                'type' => 'article',
                'read_time' => 9,
                'duration' => '9 minutes',
                'thumbnail' => 'git-workflow.jpg',
                'video_url' => null,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'title' => 'Docker for Developers',
                'slug' => 'docker-for-developers',
                'excerpt' => 'Containerize your applications with Docker for consistent development environments.',
                'content' => 'Docker has revolutionized how we develop, test, and deploy applications. By containerizing applications, developers can ensure consistency across different environments...',
                'category' => 'DevOps',
                'type' => 'article',
                'read_time' => 11,
                'duration' => '11 minutes',
                'thumbnail' => 'docker-developers.jpg',
                'video_url' => 'https://youtube.com/watch?v=example3',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'title' => 'Testing in Laravel',
                'slug' => 'testing-in-laravel',
                'excerpt' => 'Write comprehensive tests for your Laravel applications using PHPUnit and Laravel testing tools.',
                'content' => 'Testing is a crucial part of software development. Laravel provides excellent testing tools built on top of PHPUnit. This article covers feature tests, unit tests, and database testing...',
                'category' => 'Testing',
                'type' => 'article',
                'read_time' => 13,
                'duration' => '13 minutes',
                'thumbnail' => 'laravel-testing.jpg',
                'video_url' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert data ke database
        DB::table('articles')->insert($articles);

        // Atau jika menggunakan Model (uncomment baris di bawah dan comment baris di atas)
        // foreach ($articles as $article) {
        //     Article::create($article);
        // }
    }
}
