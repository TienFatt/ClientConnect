<!DOCTYPE html>
<html>
<head>
    <title>Tickets Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Tickets Report</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Assigned To</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->customer->name }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $ticket->priority)) }}</td>
                    <td>{{ $ticket->assignedUser ? $ticket->assignedUser->name : 'Unassigned' }}</td> <!-- Show user name or 'Unassigned' -->
                    <td>{{ $ticket->created_at }}</td>
                    <td>{{ $ticket->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
