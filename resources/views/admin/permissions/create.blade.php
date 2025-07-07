@extends('admin.layouts.app')
@section('title', 'Create Permission')

@section('content')
    <div class="container mx-auto px-4 py-8 lg:px-6">
        <!-- Card Container -->
        <div class="max-w-lg mx-auto bg-white rounded-xl shadow-lg border border-gray-100 p-8">
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight mb-6">Add New Permission</h2>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('admin.permissions.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Permission Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Permission Name</label>
                    <input id="name" name="name" value="{{ old('name') }}" type="text"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        required>
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end items-center gap-4">
                    <a href="{{ route('admin.permissions.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                        <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Save Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
