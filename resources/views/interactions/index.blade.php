@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Interactions</h1>
    <a href="{{ route('interactions.create') }}" class="mb-4 inline-block bg-blue-500 text-white font-semibold px-4 py-2 rounded shadow hover:bg-blue-600">Log New Interaction</a>
    <div class="overflow-x-auto">
        @if ($interactions->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">No Data!</strong>
                <span class="block sm:inline">No interactions have been logged yet.</span>
            </div>
        @else
            <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Customer</th>
                        <th class="py-3 px-6 text-left">Date & Time</th>
                        <th class="py-3 px-6 text-left">Type</th>
                        <th class="py-3 px-6 text-left">Notes</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($interactions as $interaction)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $interaction->customer->name }}</td>
                            <td class="py-3 px-6">{{ $interaction->date_time }}</td>
                            <td class="py-3 px-6">{{ str_replace('_', ' ', ucfirst($interaction->interaction_type)) }}</td>
                            <td class="py-3 px-6">{{ $interaction->notes }}</td>
                            <td class="py-3 px-6 flex space-x-2">
                                <a href="{{ route('interactions.edit', $interaction->id) }}" class="bg-yellow-500 text-white font-semibold px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('interactions.destroy', $interaction->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white font-semibold px-2 py-1 rounded hover:bg-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
