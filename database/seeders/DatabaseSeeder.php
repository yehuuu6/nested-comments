<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $ownUser = User::factory()->create([
            'name' => 'Eren Aydin',
            'email' => 'test@example.com',
        ]);

        $users->push($ownUser);

        $posts = Post::factory(20)
            ->recycle($users)
            ->create();

        foreach ($posts as $post) {
            $comments = Comment::factory(rand(0, 5))
                ->recycle($users)
                ->create([
                    'post_id' => $post->id,
                    'parent_id' => null,
                    'commentable_id' => $post->id,
                    'commentable_type' => $post->getMorphClass(),
                ]);

            foreach ($comments as $comment) {
                $this->createReplies($comment, 0, $users);
            }
        }
    }

    private function createReplies(Comment $comment, int $depth = 0, $users): void
    {

        if (rand(0, 1)) {
            return;
        }

        if ($depth > 3) {
            return;
        }

        $parentId = $comment->parent_id ?? $comment->id;

        $replies = Comment::factory(rand(0, 5))
            ->recycle($users)
            ->create([
                'post_id' => $comment->post_id,
                'parent_id' => $parentId,
                'commentable_id' => $comment->id,
                'commentable_type' => $comment->getMorphClass(),
            ]);

        foreach ($replies as $reply) {
            $this->createReplies($reply, $depth + 1, $users);
        }
    }
}