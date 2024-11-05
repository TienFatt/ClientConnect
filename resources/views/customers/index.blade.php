@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
		<div class="container mx-auto px-4 py-8">
			<div class="flex justify-between items-center mb-6">
				<div class="mb-4">
				</div>
				<a href="{{ route('customers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
					Add Customer
				</a>
			</div>

			@if($customers->isEmpty())
				<div class="bg-yellow-100 text-yellow-700 p-4 rounded-md">
					No customers found. Please add a new customer.
				</div>
			@else
				<div class="bg-white p-4 shadow rounded-lg w-11/12 mx-auto mt-4"> 
					<div class="mt-6">
						<h2 class="text-xl font-semibold mb-2">Customers</h2>
						<table id="customersTable" class="min-w-full bg-white shadow rounded-lg overflow-hidden">
							<thead>
								<tr class="bg-gray-200">
									<th class="py-2 px-4 border">ID</th>
									<th class="py-2 px-4 border">Name</th>
									<th class="py-2 px-4 border">Email</th>
									<th class="py-2 px-4 border">ID Number</th>
									<th class="py-2 px-4 border">Phone Number</th>
									<th class="py-2 px-4 border">Address</th>
									<th class="py-2 px-4 border">Notes</th>
									<th class="py-2 px-4 border">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($customers as $customer)
									<tr class="hover:bg-gray-100">
										<td class="py-2 px-4 border">{{ $customer->id }}</td>
										<td class="py-2 px-4 border">{{ $customer->name }}</td>
										<td class="py-2 px-4 border">{{ $customer->email }}</td>
										<td class="py-2 px-4 border">{{ $customer->id_number }}</td>
										<td class="py-2 px-4 border">{{ $customer->phone }}</td>
										<td class="py-2 px-4 border">{{ $customer->address }}</td>
										<td class="py-2 px-4 border">{{ $customer->notes }}</td>
										<td class="py-2 px-4 border">
											<a href="{{ route('customers.edit', $customer->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
											<form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline-block">
												@csrf
												@method('DELETE')
												<button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection





