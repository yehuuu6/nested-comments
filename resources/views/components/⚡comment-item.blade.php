<?php

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

new class extends Component {
    public Comment $comment;
    public Post $post;
};
?>

<div class="p-4">
    {{ $comment->content }}

    @if ($comment->replies()->exists())
        @island(lazy: true)
            @placeholder
                <!-- Loading indicator -->
                <div class="animate-pulse">
                    <div class="h-32 bg-gray-200 rounded"></div>
                </div>
            @endplaceholder
            <div class="mt-4 pl-6 border-l border-gray-300 space-y-5">
                @foreach ($comment->replies as $reply)
                    <livewire:comment-item :post="$post" :comment="$reply" :key="$reply->id" />
                @endforeach
            </div>
        @endisland
    @endif
</div>
