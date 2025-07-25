@extends('admin.layouts.app')

@section('title', 'Edit Comment')

@section('content')
    <div class="container mx-auto px-4 py-8 lg:px-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit Comment</h2>

        <form action="{{ route('admin.comments.update', $comment) }}" method="POST"
            class="space-y-6 bg-white p-6 rounded-lg shadow-md">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Comment</label>
                <textarea name="body" class="form-textarea w-full mt-1" rows="4">{{ old('body', $comment->body) }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
@endsection
