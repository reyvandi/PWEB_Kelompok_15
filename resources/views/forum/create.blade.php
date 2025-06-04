{{-- view/forum/create.blade --}}

@extends('layouts.app')

@section('title', 'Buat Topik Baru - Komunitas Petani')

@section('content')
<div class="container mx-auto px-4 py-6">
    <nav class="text-sm text-gray-500 mb-4">
        <a href="{{ route('forum.index') }}" class="hover:text-green-600">Forum</a>
        <span class="mx-2">></span>
        <span>Buat Topik Baru</span>
    </nav>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Buat Topik Diskusi Baru</h1>

        <form action="{{ route('forum.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="category_id" id="category_id"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                {{ old('category_id', $selectedCategory) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Topik</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                       placeholder="Masukkan judul topik diskusi..." required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten</label>
                <textarea name="content" id="content" rows="8"
                          class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                          placeholder="Tulis konten diskusi Anda..." required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                    Buat Topik
                </button>
                <a href="{{ route('forum.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
