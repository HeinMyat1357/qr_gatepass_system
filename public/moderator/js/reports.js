document.addEventListener('DOMContentLoaded', function () {
    console.log('Reports script loaded');

    // Set up event listeners
    setupReportForm();
    initializeReportChart();
    setupReportActions();
});

/**
 * Set up report form event listeners
 */
function setupReportForm() {
    const reportTypeSelect = document.getElementById('report-type');
    if (reportTypeSelect) {
        reportTypeSelect.addEventListener('change', function () {
            const customDateRange = document.getElementById('custom-date-range');
            if (this.value === 'custom') {
                customDateRange.classList.remove('d-none');
            } else {
                customDateRange.classList.add('d-none');
            }
        });
    }

    const reportForm = document.getElementById('report-form');
    if (reportForm) {
        reportForm.addEventListener('submit', function (e) {
            e.preventDefault();
            generateReport();
        });
    }
}

/**
 * Set up report action buttons
 */
function setupReportActions() {
    const printReportBtn = document.getElementById('btn-print-report');
    if (printReportBtn) {
        printReportBtn.addEventListener('click', function () {
            print();
        });
    }

    const downloadReportBtn = document.getElementById('btn-download-report');
    if (downloadReportBtn) {
        downloadReportBtn.addEventListener('click', function () {
            alert('Download feature coming soon.');
        });
    }
}

/**
 * Generate the report with mock data
 */
function generateReport() {
    const reportType = document.getElementById('report-type').value;
    const userType = document.getElementById('report-usertype').value;
    const location = document.getElementById('report-location').value;

    let startDate, endDate;
    const now = new Date();
    endDate = now.toISOString().split('T')[0];

    if (reportType === 'custom') {
        startDate = document.getElementById('report-start-date').value;
        endDate = document.getElementById('report-end-date').value;
        if (!startDate || !endDate) {
            alert('Please select both start and end dates.');
            return;
        }
    } else if (reportType === 'weekly') {
        const start = new Date(now);
        start.setDate(now.getDate() - 7);
        startDate = start.toISOString().split('T')[0];
    } else if (reportType === 'monthly') {
        const start = new Date(now);
        start.setDate(now.getDate() - 30);
        startDate = start.toISOString().split('T')[0];
    } else {
        startDate = endDate; // daily
    }

    updateReportChart(reportType, startDate, endDate);
    updateReportTable(userType, location);
    updateSummary(userType);

    alert(`Report generated: ${startDate} to ${endDate}`);
}

/**
 * Initialize report chart
 */
function initializeReportChart() {
    const canvas = document.getElementById('report-chart');
    if (!canvas) return;

    window.reportChart = new Chart(canvas, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            datasets: [
                { label: 'Present', data: [42, 45, 40, 43, 46], backgroundColor: '#198754' },
                { label: 'Late', data: [5, 3, 6, 4, 2], backgroundColor: '#ffc107' },
                { label: 'Absent', data: [3, 2, 4, 3, 2], backgroundColor: '#dc3545' }
            ]
        },
        options: {
            responsive: true,
            stacked: true,
            scales: {
                x: { stacked: true },
                y: { stacked: true, beginAtZero: true }
            }
        }
    });
}

/**
 * Update chart with new data
 */
function updateReportChart(type, start, end) {
    if (!window.reportChart) return;

    // You can customize this logic later with real API calls
    const newLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
    const present = [40, 42, 44, 41, 43];
    const late = [4, 3, 5, 2, 3];
    const absent = [2, 2, 1, 3, 2];

    window.reportChart.data.labels = newLabels;
    window.reportChart.data.datasets[0].data = present;
    window.reportChart.data.datasets[1].data = late;
    window.reportChart.data.datasets[2].data = absent;
    window.reportChart.update();
}

/**
 * Update report table with sample data
 */
function updateReportTable(userType, location) {
    const table = document.getElementById('report-table-body');
    if (!table) return;

    table.innerHTML = `
        <tr>
            <td>John Doe</td>
            <td><span class="badge bg-info">Student</span></td>
            <td>Main Entrance</td>
            <td>2025-07-15</td>
            <td>08:00 AM</td>
            <td>03:00 PM</td>
            <td>7h</td>
            <td><span class="badge bg-success">Present</span></td>
        </tr>
    `;
}

/**
 * Update summary section
 */
function updateSummary(userType) {
    document.getElementById('total-records').textContent = '50';
    document.getElementById('attendance-rate').textContent = '92%';
    document.getElementById('avg-duration').textContent = '6.5h';
    document.getElementById('late-entries').textContent = '5';
}
