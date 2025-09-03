<?php
use function Livewire\Volt\{state, mount, action};

use App\Models\Post;

state(
    ['posts' => []]
);

mount(function () {
    $this->posts = Post::with('user')
        ->latest('uploaded_at')
        ->get();

});

$deletePost = action(function ($id) {
    $post = Post::find($id);
    $url = $post->filepath;

    if (auth()->user()->discord_id !== "259583787808194560") {
        session()->flash('error', 'Unauthorized action');
        return;
    }

    try {
        if ($post) {
            $post->delete();
            $this->posts = $this->posts->filter(
                fn($p) => $p->id !== $id
            );
            $this->js('window.location.reload()');

            Storage::disk('r2')->delete($url);
        }
    } catch (\Exception $e) {
        logger("R2 Delete Error: " . $e->getMessage());
    }
})
?>

<div>
    @if($posts->count() > 0)
        <div class="space-y-8">
            @foreach($posts as $post)
                <div class="max-w-md">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full">
                            <p class="font-medium">{{ $post->user->name }}</p>
                        </div>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($post->uploaded_at)->diffForHumans() }}</p>
                    </div>
                    <img src="{{ $post->url }}" alt="Post by {{ $post->user->name }}" class="w-full rounded-lg mb-2">
                    @if(auth()->user()->discord_id === "259583787808194560")
                        <div class="flex justify-end">
                            <button wire:click="deletePost({{ $post->id }})"
                                wire:confirm="Are you sure you want to delete this post?"
                                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                Delete
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p>No posts available</p>
    @endif
</div>