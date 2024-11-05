@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
	<!-- Flash Messages -->
		@if (session('success'))
			<div class="mb-4">
				<div class="bg-green-100 text-green-700 p-3 rounded">
					{{ session('success') }}
				</div>
			</div>
		@endif
    <div class="flex justify-between items-center mb-6">
		<div class="container mx-auto px-4 py-8">
			<div class="flex justify-between items-center mb-6">
				<div class="mb-4">
				</div>
				<a href="{{ route('tickets.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Create New Ticket</a>
			</div>
			<div class="bg-white p-4 shadow rounded-lg w-11/12 mx-auto mt-4"> 
				<div class="mt-6">
					<h2 class="text-xl font-semibold mb-2">Tickets</h2>

					<!-- Filtering Options -->
					<div class="flex mb-4">
						<div class="mr-4">
							<label for="statusFilter" class="block text-sm font-medium text-gray-700">Status:</label>
							<select id="statusFilter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
								<option value="">All</option>
								<option value="open">Open</option>
								<option value="closed">Closed</option>
								<option value="pending">Pending</option>
								<!-- Add more statuses as needed -->
							</select>
						</div>
						<div>
							<label for="priorityFilter" class="block text-sm font-medium text-gray-700">Priority:</label>
							<select id="priorityFilter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
								<option value="">All</option>
								<option value="low">Low</option>
								<option value="medium">Medium</option>
								<option value="high">High</option>
								<!-- Add more priorities as needed -->
							</select>
						</div>
					</div>

					<table id="ticketsTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
						<thead>
							<tr class="bg-gray-200">
								<th class="py-2 px-4 border-b border-gray-300 text-left">ID</th>
								<th class="py-2 px-4 border-b border-gray-300 text-left">Customer</th>
								<th class="py-2 px-4 border-b border-gray-300 text-left">Title</th>
								<th class="py-2 px-4 border-b border-gray-300 text-left">Status</th>
								<th class="py-2 px-4 border-b border-gray-300 text-left">Priority</th>
								<th class="py-2 px-4 border-b border-gray-300 text-left">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($tickets as $ticket)
								<tr>
									<td class="py-2 px-4 border-b border-gray-300">{{ $ticket->id }}</td>
									<td class="py-2 px-4 border-b border-gray-300">{{ $ticket->customer->name }}</td>
									<td class="py-2 px-4 border-b border-gray-300">{{ $ticket->title }}</td>
									<td class="py-2 px-4 border-b border-gray-300">{{ str_replace('_', ' ', ucfirst($ticket->status)); }}</td>
									<td class="py-2 px-4 border-b border-gray-300">{{ ucfirst($ticket->priority) }}</td>
									<td class="py-2 px-4 border-b border-gray-300">
										<a href="{{ route('tickets.edit', $ticket->id) }}" class="text-blue-600 hover:underline">Edit</a>
										|
										<form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
											@csrf
											@method('DELETE')
											<button type="submit" class="text-red-600 hover:underline">Delete</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
    <!-- Pagination Links (if applicable) -->
    <div class="mt-4">
        {{ $tickets->links() }} <!-- If using pagination -->
    </div>
</div>
@endsection
