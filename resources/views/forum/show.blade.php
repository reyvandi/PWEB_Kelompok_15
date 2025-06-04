{{-- view/forum/show.blade --}}

@extends('layouts.app')

@section('title', $topic->title . ' - Komunitas Petani')

@section('content')
<div class="container mx-auto px-4 py-6">
    <nav class="text-sm text-gray-500 mb-4">
        <a href="{{ route('forum.index') }}" class="hover:text-green-600">Forum</a>
        <span class="mx-2">></span>
        <a href="{{ route('forum.category', $topic->category) }}" class="hover:text-green-600">{{ $topic->category->name }}</a>
        <span class="mx-2">></span>
        <span>{{ $topic->title }}</span>
    </nav>

    {{-- Topik Utama --}}
    <div class="bg-white rounded-lg shadow-md mb-6">
        <div class="p-6 border-b">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $topic->title }}</h1>

                    <div class="flex items-center text-sm text-gray-500">
                        <span class="bg-gray-100 px-2 py-1 rounded text-xs mr-2">{{ $topic->category->name }}</span>
                        <span>oleh {{ $topic->user->name }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $topic->created_at->diffForHumans() }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $topic->views_count }} views</span>
                    </div>
                </div>

                @if(auth()->user()->id === $topic->user_id)
                <div class="flex space-x-2">
                    <a href="{{ route('forum.edit', $topic->slug) }}"
                       class="text-blue-600 hover:text-blue-800 text-sm">Edit</a>
                    <form action="{{ route('forum.destroy', $topic->slug) }}" method="POST" class="inline"
                          onsubmit="return confirm('Yakin ingin menghapus topik ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                    </form>
                </div>
                @endif
            </div>
        </div>

        <div class="p-6">
            <div class="prose max-w-none">
                {!! nl2br(e($topic->content)) !!}
            </div>
        </div>
    </div>

    {{-- Balasan --}}
    <div class="bg-white rounded-lg shadow-md mb-6">
        <div class="bg-gray-50 px-6 py-3 border-b">
            <h2 class="font-semibold text-gray-800">Balasan ({{ $topic->replies_count }})</h2>
        </div>

        @forelse($replies as $reply)
        <div class="border-b border-gray-200 p-6 last:border-b-0">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center text-sm text-gray-500">
                    <span class="font-medium text-gray-800">{{ $reply->user->name }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ $reply->created_at->diffForHumans() }}</span>
                </div>

                @if(auth()->user()->id === $reply->user_id)
                <div class="flex space-x-2">
                    <a href="{{ route('forum.reply.edit', $reply) }}"
                       class="text-blue-600 hover:text-blue-800 text-sm">Edit</a>
                    <form action="{{ route('forum.reply.destroy', $reply) }}" method="POST" class="inline"
                          onsubmit="return confirm('Yakin ingin menghapus balasan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                    </form>
                </div>
                @endif
            </div>

            <div class="prose max-w-none">
                {!! nl2br(e($reply->content)) !!}
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-500">
            Belum ada balasan untuk topik ini.
        </div>
        @endforelse
    </div>

    {{ $replies->links() }}

    {{-- Form Balasan --}}
    @if(!$topic->is_locked)
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambahkan Balasan</h3>

        <form action="{{ route('forum.reply.store', $topic->slug) }}" method="POST">
            @csrf
            <div class="mb-4">
                <textarea name="content" rows="5"
                          class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                          placeholder="Tulis balasan Anda..." required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                Kirim Balasan
            </button>
        </form>
    </div>
    @else
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
        <p class="text-yellow-800">Topik ini telah dikunci dan tidak dapat dibalas.</p>
    </div>
    @endif
</div>
@endsection
