@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Log New Interaction</h1>
    <form action="{{ route('interactions.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
            <select name="customer_id" id="customer_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
                <option value="">Select a customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="date_time" class="block text-sm font-medium text-gray-700">Date & Time</label>
            <input type="datetime-local" name="date_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Type of Interaction</label>
            <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
                <option value="">Select type</option>
                <option value="email">Email</option>
                <option value="phone_call">Phone Call</option>
                <option value="meeting">Meeting</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea name="notes" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" rows="3"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded shadow hover:bg-blue-600">Log Interaction</button>
    </form>
</div>
@endsection
