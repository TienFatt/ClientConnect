<?php 

namespace App\Http\Controllers;

use App\Models\Interaction;
use App\Models\Customer;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    public function index()
    {
        $interactions = Interaction::with('customer')->get();
        return view('interactions.index', compact('interactions'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('interactions.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date_time' => 'required|date',
            'type' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        Interaction::create([
			'customer_id' => $request->customer_id,
			'date_time' => $request->date_time,
			'interaction_type' => $request->type, // Make sure to include this
			'notes' => $request->notes,
		]);

        return redirect()->route('interactions.index')->with('success', 'Interaction logged successfully!');
    }

    public function edit($id)
    {
        $interaction = Interaction::findOrFail($id);
        $customers = Customer::all();
        return view('interactions.edit', compact('interaction', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date_time' => 'required|date',
            'type' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $interaction = Interaction::findOrFail($id);
        $interaction->update($request->all());

        return redirect()->route('interactions.index')->with('success', 'Interaction updated successfully!');
    }

    public function destroy($id)
    {
        $interaction = Interaction::findOrFail($id);
        $interaction->delete();

        return redirect()->route('interactions.index')->with('success', 'Interaction deleted successfully!');
    }
}
