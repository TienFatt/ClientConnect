<?php 

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Interaction;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $pendingFollowUps = Ticket::whereIn('status', ['open', 'in_progress'])->count();
		$activeTickets = Ticket::whereIn('status', ['open', 'in progress', 'resolved'])->count();

        // Fetch ticket statuses
        $ticketStatusCounts = Ticket::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        // Fetch recent interactions
        $recentInteractions = Interaction::with('customer')
            ->latest()
            ->take(10)
            ->get();

        // For the interaction chart
        $interactionDates = Interaction::select(DB::raw('DATE(date_time) as date'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('date');

        $interactionCounts = Interaction::select(DB::raw('DATE(date_time) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count');

        return view('dashboard', compact('totalCustomers', 'pendingFollowUps', 'activeTickets', 'ticketStatusCounts', 'recentInteractions', 'interactionDates', 'interactionCounts'));
    }
}

