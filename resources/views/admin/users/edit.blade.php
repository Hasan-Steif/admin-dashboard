@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="container mx-auto px-4 py-8 lg:px-6">
        <div class="max-w-lg mx-auto bg-white rounded-xl shadow-lg border border-gray-100 p-8">
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight mb-6">Edit User</h2>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="form-input w-full mt-1">
                    @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="form-input w-full mt-1">
                    @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password <span class="text-gray-500">(Optional)</span></label>
                    <input id="password" name="password" type="password" class="form-input w-full mt-1">
                    @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-input w-full mt-1">
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select id="role" name="role" class="form-select w-full mt-1">
                        <option value="">-- Select Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->roles->first()?->id == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    @error('role')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex justify-end items-center gap-4">
                    <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded hover:bg-blue-700">Update User</button>
                </div>
            </form>
        </div>
    </div>
@endsection
