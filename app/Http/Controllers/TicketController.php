<?php 
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('customer')->paginate(10); // Fetch tickets with customer relationship
		return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
		$customers = Customer::all(); // Get all customers
		$users = User::all(); // Get all users for assignment
		return view('tickets.create', compact('customers', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,in_progress,resolved,closed',
            'priority' => 'required|in:low,medium,high',
        ]);

        Ticket::create($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
	{
		$customers = Customer::all(); // Get all customers
		$users = User::all(); // Get all users for assignment
		return view('tickets.edit', compact('ticket', 'customers', 'users'));
	}


    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,in_progress,resolved,closed',
            'priority' => 'required|in:low,medium,high',
        ]);

        $ticket->update($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }
	
	public function search(Request $request)
	{
		$query = $request->input('query');

		$tickets = Ticket::where('title', 'like', "%{$query}%")
					->orWhere('description', 'like', "%{$query}%")
					->get();

		return view('tickets.index', compact('tickets'));
	}
	
	public function filter(Request $request)
	{
		$status = $request->input('status');
		$priority = $request->input('priority');

		$tickets = Ticket::when($status, function ($query) use ($status) {
						return $query->where('status', $status);
					})
					->when($priority, function ($query) use ($priority) {
						return $query->where('priority', $priority);
					})
					->get();

		return view('tickets.index', compact('tickets'));
	}
}
