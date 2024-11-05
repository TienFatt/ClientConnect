@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-lg">
    <h1 class="text-3xl font-semibold text-gray-700 mb-6">Add New Customer</h1>
	 <!-- Display validation errors -->
		@if ($errors->any())
			<div class="bg-red-200 text-red-600 p-4 rounded mb-4">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		
    <form action="{{ route('customers.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
            <input type="text" name="name" id="name" required
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" name="email" id="email" required
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-4">
            <label for="id_number" class="block text-gray-700 font-medium mb-2">ID Number</label>
            <input type="text" name="id_number" id="id_number"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
            <input type="text" name="phone" id="phone"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700 font-medium mb-2">Address</label>
            <input type="text" name="address" id="address"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-4">
            <label for="notes" class="block text-gray-700 font-medium mb-2">Notes</label>
            <textarea name="notes" id="notes" rows="3"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"></textarea>
        </div>

        <div class="flex justify-center mt-6">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                Add Customer
            </button>
        </div>
    </form>
</div>
@endsection
