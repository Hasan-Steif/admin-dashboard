@extends('admin.layouts.app')

@section('title', 'Edit Role')

@section('content')
    <div class="container mx-auto px-4 py-8 lg:px-6">
        <div class="max-w-lg mx-auto bg-white rounded-xl shadow-lg border border-gray-100 p-8">
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight mb-6">Edit Role</h2>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Role Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Role Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $role->name) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500"
                        required>
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Permissions -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Permissions</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($permissions as $perm)
                            <label class="inline-flex items-center space-x-2">
                                <input type="checkbox" name="permissions[]" value="{{ $perm->name }}"
                                    {{ in_array($perm->name, $rolePermissions) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="text-sm text-gray-700">{{ ucfirst($perm->name) }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end items-center gap-4 pt-4">
                    <a href="{{ route('admin.roles.index') }}"
                        class="text-sm font-medium text-gray-600 hover:text-gray-800 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                        Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
