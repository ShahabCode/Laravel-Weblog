<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'برنامه‌نویسی', 'slug' => 'programming'],
            ['name' => 'طراحی وب', 'slug' => 'web-design'],
            ['name' => 'هوش مصنوعی', 'slug' => 'ai'],
            ['name' => 'شبکه و امنیت', 'slug' => 'security'],
            ['name' => 'دیتابیس', 'slug' => 'database'],
            ['name' => 'اخبار فناوری', 'slug' => 'tech-news'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                ['name' => $category['name']]
            );
        }
    }
}
