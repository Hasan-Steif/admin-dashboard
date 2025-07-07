@extends('admin.layouts.app')

@section('title', 'Create Category')

@section('content')
    <div class="container mx-auto px-4 py-8 lg:px-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Create New Category</h2>

        <form action="{{ route('admin.categories.store') }}" method="POST"
            class="space-y-6 bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-input w-full mt-1">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
@endsection
