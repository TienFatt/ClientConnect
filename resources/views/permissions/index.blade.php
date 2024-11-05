@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Manage Permissions</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('permissions.assign') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="role" class="block text-gray-700">Select Role:</label>
            <select name="role" id="role" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                <option value="">-- Select a Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
            @error('role')
                <div class="text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>

        <h2 class="text-xl font-semibold mb-2">Available Permissions:</h2>
        <div class="mb-4">
            @foreach ($permissions as $permission)
                <div class="flex items-center mb-2">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission-{{ $permission->id }}" class="mr-2">
                    <label for="permission-{{ $permission->id }}">{{ ucfirst($permission->name) }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Assign Permissions</button>
    </form>
</div>
@endsection
