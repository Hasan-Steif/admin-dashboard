@extends('admin.layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="container mx-auto px-4 py-8 lg:px-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit Post</h2>

        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-input w-full mt-1">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" class="form-select w-full mt-1">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Short Description</label>
                <textarea name="description" class="form-textarea w-full mt-1" rows="3">{{ old('description', $post->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Full Content</label>
                <textarea name="body" class="form-textarea w-full mt-1" rows="5">{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                @if ($post->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-32 h-20 object-cover rounded shadow">
                    </div>
                @endif
                <input type="file" name="image" class="form-input w-full mt-1">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="is_published" class="form-select w-full mt-1">
                    <option value="0" @selected(old('is_published', $post->is_published) == '0')>Draft</option>
                    <option value="1" @selected(old('is_published', $post->is_published) == '1')>Published</option>
                </select>
                @error('is_published')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
