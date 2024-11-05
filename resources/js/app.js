import './bootstrap';

import Chart from 'chart.js/auto';

// import { Chart, registerables } from 'chart.js';
// Chart.register(...registerables);

import 'datatables.net-dt/css/dataTables.dataTables.css'; // Import DataTables CSS
import $ from 'jquery'; // Import jQuery
import dt from 'datatables.net'; // Import DataTables

document.addEventListener('DOMContentLoaded', function () {
    // Initialize the ticket status chart
    const ticketStatusCounts = window.ticketStatusCounts || {}; // Use a global variable or data passed from Blade
    const ticketLabels = Object.keys(ticketStatusCounts);
    const ticketData = Object.values(ticketStatusCounts);
    
    const ticketsCtx = document.getElementById('ticketsChart').getContext('2d');
    new Chart(ticketsCtx, {
        type: 'bar',
        data: {
            labels: ticketLabels,
            datasets: [{
                label: 'Ticket Statuses',
                data: ticketData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
			responsive: false,
			maintainAspectRatio: false, // Allow height to be controlled independently
        }
    });
});

$(document).ready(function() {
    $('#customersTable').DataTable({
        responsive: true,
        pageLength: 10,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search customers..."
        }
    });
	
	$('#recentInteractionsTable').DataTable({
		responsive: true,
		pageLength: 25, // Set the page length to 25
		lengthMenu: [ 10, 25, 50, 100 ], // Optional: allow users to change page length
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search interactions..."
		}
	});
	
	// Initialize the DataTable
    const table = $('#ticketsTable').DataTable({
        responsive: true,
        pageLength: 10,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search tickets..."
        }
    });

    // Custom filter for Status
    $('#statusFilter').on('change', function() {
        const selectedStatus = $(this).val();
        table.column(3).search(selectedStatus ? `^${selectedStatus}$` : '', true, false).draw();
    });

    // Custom filter for Priority
    $('#priorityFilter').on('change', function() {
        const selectedPriority = $(this).val();
        table.column(4).search(selectedPriority ? `^${selectedPriority}$` : '', true, false).draw();
    });
});
