@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Generate Reports</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('reports.generate') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Report Type:</label>
                <select name="type" id="type" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                    <option value="customers">Customers</option>
                    <option value="tickets">Tickets</option>
                </select>
            </div>

            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700">Date From:</label>
                <input type="date" name="date_from" id="date_from" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
            </div>

            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700">Date To:</label>
                <input type="date" name="date_to" id="date_to" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
            </div>

            <div id="status-filter" class="hidden">
                <label for="status" class="block text-sm font-medium text-gray-700">Ticket Status:</label>
                <select name="status" id="status" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                    <option value="">All</option>
                    <option value="open">Open</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                    <option value="closed">Closed</option>
                </select>
            </div>

            <div>
                <label for="format" class="block text-sm font-medium text-gray-700">Report Format:</label>
                <select name="format" id="format" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                    <option value="csv">CSV</option>
                    <option value="pdf">PDF</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white hover:bg-green-600 text font-bold py-2 px-4 rounded transition duration-150">Generate Report</button>
        </form>
    </div>
</div>

<script>
    // Show or hide the status filter based on the report type
    document.getElementById('type').addEventListener('change', function() {
        const statusFilter = document.getElementById('status-filter');
        statusFilter.classList.toggle('hidden', this.value !== 'tickets');
    });
</script>
@endsection
