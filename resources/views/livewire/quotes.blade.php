<?php
use Livewire\Volt\Component;
use App\Models\Post;

new class extends Component {
    public $posts = [];

    public function mount()
    {
        $this->posts = Post::with('user')
            ->latest('uploaded_at')
            ->get();
    }
};
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
                    <img src="{{ $post->url }}" alt="Post by {{ $post->user->name }}" class="w-full rounded-lg">
                </div>
            @endforeach
        </div>
    @else
        <p>No posts available</p>
    @endif
</div>