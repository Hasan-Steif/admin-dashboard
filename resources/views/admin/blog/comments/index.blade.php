@extends('admin.layouts.app')

@section('title', 'Manage Comments')

@section('content')
<div class="container mx-auto px-4 py-8 lg:px-6">

    {{-- العنوان في منتصف الصفحة --}}
    <div class="mb-10">
        <h2 class="text-3xl font-bold text-center text-gray-900">Comment Management</h2>
    </div>

    {{-- جدول عرض التعليقات --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Post</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Author</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Comment</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($comments as $comment)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm text-blue-700">
                            {{ $comment->post->title }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $comment->user?->name ?? $comment->author_name ?? 'Guest' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">
                            {{ \Illuminate\Support\Str::limit($comment->body, 50) }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium flex gap-3">
                            <a href="{{ route('admin.comments.edit', $comment) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                            <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center px-6 py-6 text-gray-500">No comments found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($comments->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $comments->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection
