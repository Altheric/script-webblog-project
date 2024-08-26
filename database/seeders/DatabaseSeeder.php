<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            //Note to self: Don't run the seeders that rely on foreign keys first.
            CategorySeeder::class,
            UserSeeder::class,
            ArticleSeeder::class,
            CommentSeeder::class,
            ImageSeeder::class
        ]);
    }
}
