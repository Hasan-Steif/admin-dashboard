@extends('admin.layouts.app')

@section('title', 'Manage Posts')

@section('content')
    <div class="container mx-auto px-4 py-8 lg:px-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Post Management</h2>
            <a href="{{ route('admin.posts.create') }}"
                class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-sm hover:bg-blue-700 transition duration-200">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create New Post
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Title</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Author</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Views</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($posts as $post)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $post->title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $post->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $post->category->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $post->views }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full {{ $post->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $post->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium flex items-center gap-3">
                                    <a href="{{ route('admin.posts.edit', $post) }}"
                                        class="text-blue-600 hover:text-blue-800">Edit</a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center px-6 py-6 text-gray-500">No posts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($posts->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
@endsection
