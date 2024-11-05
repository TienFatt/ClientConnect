@extends('layouts.app') <!-- Extend your main layout -->

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Ticket</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="mb-4">
            <div class="bg-red-100 text-red-700 p-3 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT') <!-- Specify the method for updating the resource -->
        
        <div class="mb-4">
            <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
            <select name="customer_id" id="customer_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                <option value="">Select a Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $ticket->customer_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ old('title', $ticket->title) }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>{{ old('description', $ticket->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
            <select name="priority" id="priority" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="assigned_to" class="block text-sm font-medium text-gray-700">Assign to Team Member</label>
            <select name="assigned_to" id="assigned_to" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" optional>
                <option value="">Select a Team Member (Optional)</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $ticket->assigned_to == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">Update Ticket</button>
    </form>
</div>
@endsection
