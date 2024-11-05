<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport; // Ensure you create this export class
use App\Exports\CustomersExport; // Ensure you create this export class
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index'); // View for generating reports
    }

    public function generate(Request $request)
{
    // Validate the request
    $request->validate([
        'type' => 'required|string|in:customers,tickets,interactions',
        'date_from' => 'nullable|date',
        'date_to' => 'nullable|date',
        'status' => 'nullable|string|in:open,in_progress,resolved,closed',
        'format' => 'required|string|in:csv,pdf',
    ]);

    $reportData = null;

    // Fetch data based on the report type
    switch ($request->type) {
        case 'customers':
            $query = Customer::query();
            if ($request->date_from) {
                $query->where('created_at', '>=', $request->date_from);
            }
            if ($request->date_to) {
                $query->where('created_at', '<=', $request->date_to);
            }
            $reportData = $query->get();
            break;

        case 'tickets':
            $query = Ticket::with('customer');
            if ($request->date_from) {
                $query->where('created_at', '>=', $request->date_from);
            }
            if ($request->date_to) {
                $query->where('created_at', '<=', $request->date_to);
            }
            if ($request->status) {
                $query->where('status', $request->status);
            }
            $reportData = $query->get();
            break;
    }

    // Generate the report in the requested format
    if ($request->format === 'csv') {
        if ($request->type === 'tickets') {
            return Excel::download(new TicketsExport($reportData), 'tickets_report.csv');
        } elseif ($request->type === 'customers') {
            return Excel::download(new CustomersExport($reportData), 'customers_report.csv');
        }
    }

    $pdf = PDF::loadView('reports.' . $request->type . '_pdf', compact('reportData'));
    return $pdf->download($request->type . '_report.pdf');
}
}
