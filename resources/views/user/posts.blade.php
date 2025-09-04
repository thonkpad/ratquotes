@extends('layouts.app')

@section('title', $user->name . "'s Posts - Rat Quotes")

@section('content')
    <div>
        @if($user->posts->count() > 0)
            <div class="space-y-8">
                @foreach($user->posts as $post)
                    <div class="max-w-md">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full">
                                <p class="font-medium">{{ $post->user->name }}</p>
                            </div>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($post->uploaded_at)->diffForHumans() }}</p>
                        </div>
                        <a href="{{ route('post.show', $post) }}">
                            <img src="{{ $post->url }}" alt="Post by {{ $post->user->name }}"
                                class="w-full rounded-lg mb-2 hover:opacity-90 transition-opacity cursor-pointer">
                        </a>
                        @if(auth()->user()?->discord_id === "259583787808194560")
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
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">{{ $user->name }} hasn't posted anything yet.</p>
            </div>
        @endif
    </div>
@endsection