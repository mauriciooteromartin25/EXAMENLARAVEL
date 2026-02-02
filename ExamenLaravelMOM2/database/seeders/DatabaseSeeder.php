<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 10 usuarios
        $users = User::factory(10)->create();

        // Crear posts para cada usuario (2-5 posts por usuario)
        $users->each(function ($user) use ($users) {
            $posts = Post::factory(rand(2, 5))->create([
                'user_id' => $user->id,
            ]);

            // Crear comentarios para cada post (3-8 comentarios por post)
            $posts->each(function ($post) use ($users) {
                Comment::factory(rand(3, 8))->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                ]);
            });
        });
    }
}
