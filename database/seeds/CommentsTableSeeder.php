<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Comment;
use Faker\Generator as Faker;
class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                $newComment = new Comment;
                $newComment->name = $faker->name;
                $newComment->email = $faker->email;
                $newComment->title = $faker->sentence(3);
                $newComment->body = $faker->text(150);
                $newComment->post_id = $post->id;

                $newComment->save();
            }
        }
    }
}
