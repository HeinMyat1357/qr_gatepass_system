// Cleaned-up Main script for QR Attendance System (Laravel-based)

document.addEventListener('DOMContentLoaded', function () {
    console.log('QR Attendance System JS loaded');

    initNavbarUserInfo();
    setupSidebar();
    setupLogoutAction();
});

/**
 * Initialize navbar user information (optional: use Laravel Blade instead)
 */
function initNavbarUserInfo() {
    const userNavInfo = document.getElementById('user-nav-info');

    // This logic is only needed if you use localStorage (not recommended for Laravel auth)
    if (!userNavInfo) return;
    const userDataStr = localStorage.getItem('qr_attendance_user');
    if (!userDataStr) return;

    const userData = JSON.parse(userDataStr);
    const userNameElement = userNavInfo.querySelector('.user-name');
    const userInitialsElement = userNavInfo.querySelector('.user-initials');

    if (userNameElement) {
        userNameElement.textContent = `${userData.firstName} ${userData.lastName}`;
    }

    if (userInitialsElement) {
        userInitialsElement.textContent = userData.firstName.charAt(0) + userData.lastName.charAt(0);
    }
}

/**
 * Setup sidebar active link highlighting
 */
function setupSidebar() {
    const currentPath = window.location.pathname;

    const sidebarLinks = document.querySelectorAll('.sidebar-menu a');
    sidebarLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (currentPath.includes(href)) {
            link.classList.add('active');
        }
    });

    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('show');
        });

        document.addEventListener('click', function (event) {
            const isSidebar = sidebar.contains(event.target);
            const isToggle = sidebarToggle.contains(event.target);
            if (!isSidebar && !isToggle && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
    }
}

/**
 * Logout button click
 */
function setupLogoutAction() {
    const logoutButton = document.getElementById('navbar-logout');
    if (logoutButton) {
        logoutButton.addEventListener('click', function () {
            if (confirm('Are you sure you want to log out?')) {
                // ✅ Submit Laravel logout form if exists
                const logoutForm = document.getElementById('logout-form');
                if (logoutForm) {
                    logoutForm.submit();
                } else {
                    // Fallback: clear localStorage and redirect
                    localStorage.clear();
                    window.location.href = '/moderator/login'; // Laravel login route
                }
            }
        });
    }
}

// Utilities
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

function formatTime(date) {
    let hours = date.getHours();
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12;
    return `${hours}:${minutes} ${ampm}`;
}

function calculateDuration(startTime, endTime) {
    const diff = (endTime - startTime) / 60000;
    const hours = Math.floor(diff / 60);
    const minutes = Math.floor(diff % 60);
    return `${hours}h ${minutes}m`;
}

function showToast(message, type = 'success') {
    const toastContainer = document.getElementById('toast-container');
    if (!toastContainer) return;

    const toastEl = document.createElement('div');
    toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
    toastEl.setAttribute('role', 'alert');
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');
    toastEl.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    toastContainer.appendChild(toastEl);

    const toast = new bootstrap.Toast(toastEl, { animation: true, autohide: true, delay: 4000 });
    toast.show();

    toastEl.addEventListener('hidden.bs.toast', () => {
        toastEl.remove();
    });
}

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function isValidPhone(phone) {
    return phone.replace(/\D/g, '').length >= 10;
}
