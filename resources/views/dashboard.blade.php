@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
		<div class="container mx-auto">
			<h1 class="text-3xl font-bold mb-4">Dashboard</h1>

			<!-- Metric Cards -->
			<div class="grid grid-cols-4 gap-4 mb-6">
				<div class="p-4 bg-blue-100 rounded-lg shadow">
					<h2 class="font-semibold">Total Customers</h2>
					<p class="text-2xl">{{ $totalCustomers }}</p>
				</div>
				<div class="p-4 bg-green-100 rounded-lg shadow">
					<h2 class="font-semibold">Pending Follow-ups</h2>
					<p class="text-2xl">{{ $pendingFollowUps }}</p>
				</div>
				<div class="p-4 bg-yellow-100 rounded-lg shadow">
					<h2 class="font-semibold">Active Tickets</h2>
					<p class="text-2xl">{{ array_sum($ticketStatusCounts->toArray()) }}</p>
				</div>
			</div>
			

			<div class="container mx-auto px-4 py-8">
				<div class="flex gap-4 mt-4">
					<!-- Recent Interactions Table -->
					<div class="bg-white p-4 shadow rounded-lg w-7/10">
						<div class="mt-6">
							<h2 class="text-xl font-semibold mb-2">Recent Interactions</h2>
							<table id="recentInteractionsTable" class="min-w-full bg-white shadow rounded-lg overflow-hidden">
								<thead>
									<tr class="bg-gray-200">
										<th class="py-2 px-4 border">Date</th>
										<th class="py-2 px-4 border">Customer</th>
										<th class="py-2 px-4 border">Type</th>
										<th class="py-2 px-4 border">Notes</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($recentInteractions as $interaction)
										<tr class="hover:bg-gray-100">
											<td class="py-2 px-4 border">{{ $interaction->date_time->format('Y-m-d H:i') }}</td>
											<td class="py-2 px-4 border">{{ $interaction->customer->name }}</td>
											<td class="py-2 px-4 border">{{ str_replace('_', ' ', ucfirst($interaction->interaction_type)) }}</td>
											<td class="py-2 px-4 border">{{ $interaction->notes }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<!-- Ticket Status Chart -->
					<div class="bg-white p-4 shadow rounded-lg w-3/10">
						<div class="mt-6">
							<h2 class="text-xl font-semibold mb-4">Ticket Statuses</h2>
							<div>
								<canvas id="ticketsChart" width="400" height="400"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
    window.ticketStatusCounts = @json($ticketStatusCounts);
</script>
@endpush