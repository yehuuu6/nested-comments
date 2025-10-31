<?php

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public Post $post;
    public bool $commentForm = false;
    public string $content = '';

    #[Computed]
    public function comments()
    {
        return $this->post->comments()->simplePaginate(10);
    }

    public function render()
    {
        return $this->view()->title($this->post->title . ' - Nested Comments');
    }
};
?>

<div class="mx-auto w-[900px] p-6 bg-white shadow-md rounded-md my-24">
    <a href="{{ route('home') }}" wire:navigate class="text-blue-600 hover:underline mb-4 flex items-center gap-1">
        <x-tabler-arrow-left class="size-6" />
        Back to Home
    </a>
    <h1 class="text-3xl font-bold mb-4">{{ $this->post->title }}</h1>
    <p class="text-gray-700 mb-6">{{ $this->post->content }}</p>
    <p class="text-sm text-gray-500">Posted on {{ $this->post->created_at->format('M d, Y') }}</p>
    <div class="mt-8 border-t border-gray-200 pt-6">
        <div class="p-1 md:p-6">
            <div class="p-3 md:p-0">
                <div>
                    <div wire:show="!commentForm">
                        <button x-on:click="$wire.commentForm = true"
                            class="rounded-3xl w-full py-2 md:py-3 px-3 md:px-4 border border-gray-300 hover:border-gray-400 text-sm text-gray-500 font-normal cursor-text text-left">
                            Add a comment...
                        </button>
                    </div>
                    <div x-cloak wire:show="commentForm">
                        <x-comment-form />
                    </div>
                </div>
            </div>
            <div class="px-2 pb-2">
                @if (!$this->comments->isNotEmpty())
                    <div>
                        <h3 class="font-semibold text-gray-600 text-base mb-3">
                            No comments yet
                        </h3>
                        <p class="text-gray-500 font-normal text-sm">
                            This post has not yet received any comments.
                            <br>
                            Be the first to start the discussion by leaving a comment.
                        </p>
                    </div>
                @else
                    @island(defer: true)
                        @placeholder
                            <!-- Loading indicator -->
                            <div class="animate-pulse">
                                <div class="h-32 bg-gray-200 rounded"></div>
                            </div>
                        @endplaceholder
                        <div class="flex flex-col gap-5 mt-10">
                            @foreach ($this->comments as $comment)
                                <livewire:comment-item :$post :$comment />
                            @endforeach
                        </div>
                    @endisland
                @endif
            </div>
        </div>
        {{ $this->comments->links() }}
    </div>
</div>
