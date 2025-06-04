@extends('layouts.app')

@section('title', 'Materi Belajar')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
    @if($article->thumbnail)
        <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-64 object-cover rounded-lg mb-4">
    @endif

    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $article->title }}</h1>
    <div class="text-gray-600 mb-2">
        <span class="font-semibold">{{ $article->category }}</span> |
        <span class="ml-2">{{ $article->created_at->format('d M Y') }}</span> |
        <span class="ml-2">{{ $article->read_time }} menit baca</span>
    </div>
    <p class="text-gray-700 mb-4">{{ $article->excerpt }}</p>
    <div class="text-gray-700">
        {!! nl2br(e($article->content)) !!}
    </div>
</div>
@endsection
