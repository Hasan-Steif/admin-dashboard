@extends('layouts.frontend')

@section('title', $category->name)

@section('content')
<section class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-12">
    <h1 class="text-4xl md:text-5xl font-extrabold text-center mb-12 text-gray-800 animate__animated animate__fadeIn animate__delay-1s">
        {{ $category->name }} Posts
    </h1>

    @forelse($category->posts as $post)
        <article class="bg-white shadow-2xl rounded-2xl p-8 mb-10 card-hover fade-in transition-all duration-300">
            <h2 class="text-3xl font-bold text-blue-700 mb-3 hover:text-blue-800 transition-colors duration-200">
                {{ $post->title }}
            </h2>

            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                <span>By {{ $post->user->name }}</span>
                <span>{{ $post->created_at->format('M d, Y') }}</span>
            </div>

            <p class="text-gray-600 mb-6 leading-relaxed">{{ $post->description }}</p>

            @if ($post->image)
                <div class="relative mb-6">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                         class="w-full h-80 object-cover rounded-xl transition-transform duration-500 hover:scale-105">
                </div>
            @endif

            <h3 class="text-xl font-semibold mb-3 text-gray-700">Comments</h3>
            <div class="space-y-4 mb-6">
                @forelse($post->comments as $comment)
                    <div class="bg-gray-50 p-5 rounded-xl fade-in border-l-4 border-blue-500">
                        <p class="font-semibold text-gray-800 mb-1">
                            {{ $comment->user->name ?? $comment->author_name ?? 'Guest' }}
                        </p>
                        <p class="text-gray-600">{{ $comment->body }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">No comments yet.</p>
                @endforelse
            </div>

            <h4 class="text-lg font-semibold mb-3 text-gray-700">Leave a Comment</h4>
            <form action="{{ route('frontend.comments.store', $post) }}" method="POST" class="space-y-5">
                @csrf

                @guest
                    <input type="text" name="author_name" placeholder="Your Name"
                           class="w-full p-4 rounded-full bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300"
                           required>
                @endguest

                <textarea name="body" rows="4" placeholder="Your Comment..."
                          class="w-full p-4 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300"
                          required></textarea>

                <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-full font-medium hover:shadow-xl hover:bg-blue-700 transition duration-300">
                    Submit
                </button>
            </form>
        </article>
    @empty
        <p class="text-center text-gray-500 text-xl font-medium">No posts found in this category.</p>
    @endforelse
</section>
@endsection
