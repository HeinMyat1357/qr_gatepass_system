// Dashboard functionality for QR Attendance System

document.addEventListener('DOMContentLoaded', function () {
    console.log('Dashboard script loaded');

    // Initialize dashboard components (Laravel handles auth!)
    initDashboardCharts();
    loadRecentActivity();
    loadAttendanceStats();
});

/**
 * Initialize dashboard charts
 */
function initDashboardCharts() {
    // Attendance Trend Chart
    const attendanceCtx = document.getElementById('attendance-chart');
    if (attendanceCtx) {
        new Chart(attendanceCtx, {
            type: 'line',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [{
                    label: 'Attendance Rate',
                    data: [95, 88, 92, 96, 90, 75, 40],
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    borderColor: '#0d6efd',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function (value) {
                                return value + '%';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.raw + '%';
                            }
                        }
                    }
                }
            }
        });
    }

    // User Types Distribution Chart
    const userTypesCtx = document.getElementById('user-types-chart');
    if (userTypesCtx) {
        new Chart(userTypesCtx, {
            type: 'doughnut',
            data: {
                labels: ['Students', 'Teachers', 'Staff', 'Visitors'],
                datasets: [{
                    data: [65, 15, 12, 8],
                    backgroundColor: ['#0d6efd', '#198754', '#6c757d', '#ffc107'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Location Activity Chart
    // const locationCtx = document.getElementById('location-chart');
    // if (locationCtx) {
    //     new Chart(locationCtx, {
    //         type: 'bar',
    //         data: {
    //             labels: ['Main Entrance', 'Classroom 1', 'Library', 'Cafeteria', 'Admin Office'],
    //             datasets: [{
    //                 label: 'Entries Today',
    //                 data: [120, 45, 35, 80, 25],
    //                 backgroundColor: '#0d6efd',
    //             }]
    //         },
    //         options: {
    //             responsive: true,
    //             maintainAspectRatio: false,
    //             scales: {
    //                 y: {
    //                     beginAtZero: true
    //                 }
    //             }
    //         }
    //     });
    // }
}

/**
 * Load recent activity data
 */
function loadRecentActivity() {
    const activityTableBody = document.getElementById('recent-activity-table');
    if (!activityTableBody) return;

    const recentActivities = [
        { user: 'John Doe', action: 'Checked In', location: 'Main Entrance', time: '08:15 AM', status: 'success' },
        { user: 'Sarah Johnson', action: 'Checked In', location: 'Admin Office', time: '08:00 AM', status: 'success' },
        { user: 'Mike Williams', action: 'Checked In', location: 'Admin Office', time: '08:30 AM', status: 'success' },
        { user: 'Emily Clark', action: 'Checked In', location: 'Library', time: '09:15 AM', status: 'warning' },
        { user: 'Robert Miller', action: 'Checked In', location: 'Main Entrance', time: '10:00 AM', status: 'info' }
    ];

    activityTableBody.innerHTML = '';

    recentActivities.forEach(activity => {
        const row = document.createElement('tr');
        let badgeClass = 'bg-success';
        if (activity.status === 'warning') badgeClass = 'bg-warning';
        if (activity.status === 'danger') badgeClass = 'bg-danger';
        if (activity.status === 'info') badgeClass = 'bg-info';

        row.innerHTML = `
            <td>${activity.user}</td>
            <td>${activity.action}</td>
            <td>${activity.location}</td>
            <td>${activity.time}</td>
            <td><span class="badge ${badgeClass}">${activity.action}</span></td>
        `;
        activityTableBody.appendChild(row);
    });
}

/**
 * Load attendance statistics
 */
function loadAttendanceStats() {
    updateStatCounter('total-students', 250);
    updateStatCounter('present-today', 231);
    updateStatCounter('present-rate', 92.4);
    updateStatCounter('absent-today', 19);
    updateStatCounter('visitors-today', 15);
    updateStatCounter('late-arrivals', 8);
}

/**
 * Update statistic counter with animation
 */
function updateStatCounter(elementId, value) {
    const element = document.getElementById(elementId);
    if (!element) return;

    let currentValue = 0;
    const increment = value / 20;
    const interval = setInterval(() => {
        currentValue += increment;
        if (currentValue >= value) {
            clearInterval(interval);
            currentValue = value;
        }
        if (elementId === 'present-rate') {
            element.textContent = currentValue.toFixed(1) + '%';
        } else {
            element.textContent = Math.round(currentValue);
        }
    }, 40);
}
