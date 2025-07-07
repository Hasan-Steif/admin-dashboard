@extends('layouts.frontend')

@section('title', 'Categories')

@section('content')
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <h1
            class="text-4xl md:text-5xl font-extrabold text-center mb-12 text-gray-900 animate__animated animate__fadeIn animate__delay-1s">
            Explore All Categories
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}"
                    class="relative p-8 bg-white shadow-xl rounded-xl group overflow-hidden transition transform hover:scale-[1.01] hover:shadow-2xl hover:ring-1 hover:ring-blue-100">
                    <div
                        class="absolute inset-0 bg-blue-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300 rounded-xl">
                    </div>
                    <h2
                        class="text-2xl font-semibold text-blue-700 group-hover:text-blue-800 relative z-10 transition-colors duration-300">
                        {{ $category->name }}
                    </h2>
                    <div
                        class="absolute bottom-0 left-0 w-full h-1 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left">
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center text-gray-500 text-lg">
                    No categories found.
                </div>
            @endforelse
        </div>
    </div>
@endsection
