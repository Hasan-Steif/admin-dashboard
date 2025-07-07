@extends('admin.layouts.app')

@section('title', 'Manage Categories')

@section('content')
    <div class="container mx-auto px-4 py-8 lg:px-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Category Management</h2>
            <a href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create New Category
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Slug</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $category->slug }}</td>
                            <td class="px-6 py-4 text-sm font-medium flex gap-3">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="text-blue-600 hover:text-blue-800">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center px-6 py-6 text-gray-500">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($categories->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $categories->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
@endsection
