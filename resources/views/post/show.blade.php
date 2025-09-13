@extends('layouts.app')

@section('title', 'Post by ' . $post->user->name . ' - Rat Quotes')

@push('meta')
    {{-- <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Post by {{ $post->user->name }} - Rat Quotes">
    <meta property="og:description" content="Is that a rat quotes moment">
    <meta property="og:image" content="{{ $post->url }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Rat Quotes">

    <meta name="description" content="Post by {{ $post->user->name }} on Rat Quotes">
    <meta name="author" content="{{ $post->user->name }}"> --}}

    <title>Rat Quotes</title>
    <meta name="description" content="Quoted by {{ $post->user->name }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{env.PUBLIC_SITE_URL}">
    <meta property="og:image" content="{{ $post->url }}">
    <meta name="twitter:card" content="summary_large_image">
@endpush

@section('content')
    <div class="max-w-md mx-auto">
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center space-x-2">
                <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full">
                <a href="{{ route('user.posts', $post->user) }}"
                    class="font-medium text-blue-600 hover:text-blue-800 hover:underline transition-colors">
                    {{ $post->user->name }}
                </a>
            </div>
            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($post->uploaded_at)->diffForHumans() }}</p>
        </div>
        <img src="{{ $post->url }}" alt="Post by {{ $post->user->name }}" class="w-full rounded-lg mb-2">
        @if(auth()->user()?->discord_id === "259583787808194560")
            <div class="flex justify-end">
                <button wire:click="deletePost({{ $post->id }})" wire:confirm="Are you sure you want to delete this post?"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    Delete
                </button>
            </div>
        @endif
    </div>
    </div>
@endsection