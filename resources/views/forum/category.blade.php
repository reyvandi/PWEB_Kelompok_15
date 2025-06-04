{{-- view/forum/category.blade --}}

@extends('layouts.app')

@section('title', $category->name . ' - Komunitas Petani')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <nav class="text-sm text-gray-500 mb-2">
                <a href="{{ route('forum.index') }}" class="hover:text-green-600">Forum</a>
                <span class="mx-2">></span>
                <span>{{ $category->name }}</span>
            </nav>
            <h1 class="text-3xl font-bold text-gray-800">{{ $category->name }}</h1>
            <p class="text-gray-600 mt-2">{{ $category->description }}</p>
        </div>

        <a href="{{ route('forum.create', ['category' => $category->id]) }}"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
            Buat Topik Baru
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gray-50 px-6 py-3 border-b">
            <div class="flex justify-between text-sm font-medium text-gray-700">
                <span>Topik</span>
                <span>Aktivitas Terakhir</span>
            </div>
        </div>

        @forelse($topics as $topic)
        <div class="border-b border-gray-200 p-6 hover:bg-gray-50">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        @if($topic->is_pinned)
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded mr-2">📌 Disematkan</span>
                        @endif
                        @if($topic->is_locked)
                            <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded mr-2">🔒 Dikunci</span>
                        @endif
                    </div>

                    <a href="{{ route('forum.show', $topic->slug) }}"
                       class="text-lg font-medium text-gray-800 hover:text-green-600 block mb-2">
                        {{ $topic->title }}
                    </a>

                    <div class="flex items-center text-sm text-gray-500">
                        <span>oleh {{ $topic->user->name }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $topic->created_at->diffForHumans() }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $topic->replies_count }} balasan</span>
                        <span class="mx-2">•</span>
                        <span>{{ $topic->views_count }} views</span>
                    </div>
                </div>

                @if($topic->lastReplyUser )
                <div class="text-right text-sm text-gray-500">
                    <div>Terakhir oleh {{ $topic->lastReplyUser ->name }}</div>
                    <div>{{ $topic->last_activity_at->diffForHumans() }}</div>
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-500">
            Belum ada topik dalam kategori ini.
        </div>
        @endforelse
    </div>

    {{ $topics->links() }}
</div>
@endsection
