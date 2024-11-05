<?php 

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TicketsExport implements FromCollection, WithHeadings
{
    protected $reportData;

    public function __construct($reportData)
    {
        $this->reportData = $reportData;
    }

    public function collection()
    {
        return $this->reportData->map(function ($ticket) {
            return [
                'ID' => $ticket->id,
                'Title' => $ticket->title,
                'Customer' => $ticket->customer->name,
                'Status' => ucfirst(str_replace('_', ' ', $ticket->status)),
                'Priority' => ucfirst(str_replace('_', ' ', $ticket->priority)),
                'Assigned To' => $ticket->assignedUser ? $ticket->assignedUser->name : 'Unassigned', // Include assigned user name
                'Created At' => $ticket->created_at,
                'Updated At' => $ticket->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Customer',
            'Status',
            'Priority',
            'Assigned To',
            'Created At',
            'Updated At',
        ];
    }
}
