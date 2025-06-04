{{-- view/forum/index.blade --}}

@extends('layouts.app')

@section('title', 'Komunitas Petani - Forum Diskusi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Komunitas Petani</h1>
        <a href="{{ route('forum.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
            Buat Topik Baru
        </a>
    </div>

    {{-- Kategori Forum --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($categories as $category)
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center mb-3">
                <div class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $category->color }}"></div>
                <h3 class="text-lg font-semibold text-gray-800">{{ $category->name }}</h3>
            </div>

            <p class="text-gray-600 text-sm mb-4">{{ $category->description }}</p>

            <div class="flex justify-between text-sm text-gray-500 mb-4">
                <span>{{ $category->topics_count }} Topik</span>
                <span>{{ $category->replies_count }} Balasan</span>
            </div>

            <a href="{{ route('forum.category', $category) }}"
               class="text-green-600 hover:text-green-800 font-medium text-sm">
                Lihat Diskusi →
            </a>
        </div>
        @endforeach
    </div>

    {{-- Topik Terbaru --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Diskusi Terbaru</h2>

        @foreach($recentTopics as $topic)
        <div class="border-b border-gray-200 pb-4 mb-4 last:border-b-0 last:mb-0">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <a href="{{ route('forum.show', $topic->slug) }}"
                       class="text-lg font-medium text-gray-800 hover:text-green-600">
                        {{ $topic->title }}
                    </a>

                    <div class="flex items-center text-sm text-gray-500 mt-2">
                        <span class="bg-gray-100 px-2 py-1 rounded text-xs mr-2">
                            {{ $topic->category->name }}
                        </span>
                        <span>oleh {{ $topic->user->name }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $topic->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <div class="text-right text-sm text-gray-500">
                    <div>{{ $topic->replies_count }} balasan</div>
                    <div>{{ $topic->views_count }} views</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
