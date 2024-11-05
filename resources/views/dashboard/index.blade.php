@extends('layouts.app') <!-- or your main layout with the navigation bar -->

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold">My New Dashboard</h1>
    <!-- Add your new dashboard content here -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
        <div class="bg-white p-4 shadow rounded-lg">
            <h2 class="text-lg font-semibold">Section 1</h2>
            <p>Details for section 1.</p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg">
            <h2 class="text-lg font-semibold">Section 2</h2>
            <p>Details for section 2.</p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg">
            <h2 class="text-lg font-semibold">Section 3</h2>
            <p>Details for section 3.</p>
        </div>
    </div>
</div>
@endsection
