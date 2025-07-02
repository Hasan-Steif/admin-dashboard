@extends('admin.layouts.app')

@section('title', 'Create Role')

@section('content')
<div class="container mx-auto px-4 py-8 lg:px-6">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Add New Role</h2>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.roles.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Role Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Role Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500"
                       required>
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Permissions Checkboxes -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Assign Permissions</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    @foreach ($permissions as $perm)
                        <label class="inline-flex items-center text-sm text-gray-800">
                            <input type="checkbox" name="permissions[]" value="{{ $perm->name }}"
                                   class="form-checkbox text-blue-600 border-gray-300 rounded mr-2"
                                   {{ in_array($perm->name, old('permissions', [])) ? 'checked' : '' }}>
                            {{ ucfirst($perm->name) }}
                        </label>
                    @endforeach
                </div>
                @error('permissions')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end items-center gap-4">
                <a href="{{ route('admin.roles.index') }}"
                   class="text-gray-600 hover:text-gray-800 text-sm">Cancel</a>
                <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-save mr-2"></i> Save Role
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
