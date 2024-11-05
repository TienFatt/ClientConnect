@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Interaction</h1>
    <form action="{{ route('interactions.update', $interaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">{{ $errors->first() }}</span>
                </div>
            </div>
        @endif

        <div class="mb-4">
            <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
            <select name="customer_id" id="customer_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
                <option value="">Select a customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $interaction->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="date_time" class="block text-sm font-medium text-gray-700">Date & Time</label>
            <input type="datetime-local" name="date_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" value="{{ \Carbon\Carbon::parse($interaction->date_time)->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Type of Interaction</label>
            <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
                <option value="">Select type</option>
                <option value="email" {{ $interaction->interaction_type == 'email' ? 'selected' : '' }}>Email</option>
                <option value="phone_call" {{ $interaction->interaction_type == 'phone_call' ? 'selected' : '' }}>Phone Call</option>
                <option value="meeting" {{ $interaction->interaction_type == 'meeting' ? 'selected' : '' }}>Meeting</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea name="notes" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" rows="3">{{ $interaction->notes }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded shadow hover:bg-blue-600">Update Interaction</button>
    </form>
</div>
@endsection
