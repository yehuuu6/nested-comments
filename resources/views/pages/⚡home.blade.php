<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Post;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    #[Computed]
    public function posts()
    {
        return Post::latest()->simplePaginate(5);
    }

    public function render()
    {
        return $this->view()->title('Home - Nested Comments');
    }
};
?>

<div>
    <h1 class="text-2xl font-bold mb-4">Recent Posts</h1>
    <div class="space-y-4 w-[900px]">
        @foreach ($this->posts as $post)
            <div class="border border-gray-200 rounded-md p-4 bg-white shadow-sm">
                <a href="{{ $post->showRoute() }}" wire:navigate
                    class="text-xl font-semibold hover:underline text-blue-950">{{ $post->title }}</a>
                <p class="text-gray-700 mt-2">{{ $post->body }}</p>
                <p class="text-sm text-gray-500 mt-2">Posted on {{ $post->created_at->format('M d, Y') }}</p>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $this->posts->links() }}
    </div>
</div>
