// Visitors management functionality for QR Attendance System

document.addEventListener('DOMContentLoaded', function() {
    console.log('Visitors script loaded');
    
    // Check if user is logged in
    const user = localStorage.getItem('qr_attendance_user');
    if (!user) {
        // Redirect to login if not logged in
        window.location.href = 'login.html';
        return;
    }
    
    // Set up event listeners
    setupVisitorActions();
    setupVisitorForm();
});

/**
 * Set up visitor action handlers (view QR, edit, delete)
 */
function setupVisitorActions() {
    // View visitor QR code
    const viewQRButtons = document.querySelectorAll('.view-qr');
    viewQRButtons.forEach(button => {
        button.addEventListener('click', function() {
            const visitorId = this.getAttribute('data-visitor-id');
            showVisitorQRCode(visitorId);
        });
    });
    
    // Edit visitor
    const editVisitorButtons = document.querySelectorAll('.edit-visitor');
    editVisitorButtons.forEach(button => {
        button.addEventListener('click', function() {
            const visitorId = this.getAttribute('data-visitor-id');
            editVisitor(visitorId);
        });
    });
    
    // Delete visitor
    const deleteVisitorButtons = document.querySelectorAll('.delete-visitor');
    deleteVisitorButtons.forEach(button => {
        button.addEventListener('click', function() {
            const visitorId = this.getAttribute('data-visitor-id');
            deleteVisitor(visitorId);
        });
    });
    
    // Print QR code
    const printQRButton = document.getElementById('print-visitor-qr');
    if (printQRButton) {
        printQRButton.addEventListener('click', function() {
            printVisitorQRCode();
        });
    }
    
    // Send QR code via email
    const sendQRButton = document.getElementById('send-visitor-qr-email');
    if (sendQRButton) {
        sendQRButton.addEventListener('click', function() {
            sendVisitorQRCodeByEmail();
        });
    }
}

/**
 * Set up visitor form submission
 */
function setupVisitorForm() {
    const saveVisitorButton = document.getElementById('save-visitor');
    if (saveVisitorButton) {
        saveVisitorButton.addEventListener('click', function() {
            saveNewVisitor();
        });
    }
}

/**
 * Show visitor QR code
 * @param {string} visitorId - Visitor ID
 */
function showVisitorQRCode(visitorId) {
    // Get visitor data (in a real app, this would be from API/database)
    const visitorData = getVisitorData(visitorId);
    if (!visitorData) return;
    
    // Get elements
    const qrContainer = document.getElementById('visitor-qr-container');
    const qrPrompt = qrContainer.querySelector('.select-visitor-prompt');
    const qrContent = qrContainer.querySelector('.visitor-qr-content');
    const qrCodeElement = document.getElementById('visitor-qr-code');
    const nameElement = document.getElementById('visitor-qr-name');
    const purposeElement = document.getElementById('visitor-qr-purpose');
    const validityElement = document.getElementById('visitor-qr-validity');
    
    // Hide prompt, show content
    qrPrompt.classList.add('d-none');
    qrContent.classList.remove('d-none');
    
    // Update visitor info
    nameElement.textContent = `${visitorData.name}`;
    purposeElement.textContent = visitorData.purpose;
    validityElement.textContent = `Valid until: ${visitorData.validUntil}`;
    
    // Generate QR code
    qrCodeElement.innerHTML = '';
    const qrCode = new QRCode(qrCodeElement, {
        text: JSON.stringify({
            id: visitorId,
            name: visitorData.name,
            purpose: visitorData.purpose,
            validUntil: visitorData.validUntil
        }),
        width: 200,
        height: 200,
        colorDark: '#000000',
        colorLight: '#ffffff',
        correctLevel: QRCode.CorrectLevel.H
    });
}

/**
 * Get visitor data by ID
 * @param {string} visitorId - Visitor ID
 * @returns {Object|null} - Visitor data object or null if not found
 */
function getVisitorData(visitorId) {
    // In a real app, this would be from API/database
    // For demo purposes, we'll use hardcoded data
    const visitorData = {
        'v1': {
            name: 'Robert Miller',
            purpose: 'Meeting',
            host: 'Sarah Johnson',
            validUntil: '2023-06-15 17:00',
            status: 'Active'
        },
        'v2': {
            name: 'Lisa Thompson',
            purpose: 'Parent',
            host: 'Mike Williams',
            validUntil: '2023-06-15 16:30',
            status: 'Active'
        },
        'v3': {
            name: 'James Wilson',
            purpose: 'Delivery',
            host: 'John Doe',
            validUntil: '2023-06-15 15:00',
            status: 'Active'
        },
        'v4': {
            name: 'Amy Garcia',
            purpose: 'Interview',
            host: 'Emily Clark',
            validUntil: '2023-06-15 14:30',
            status: 'Checked Out'
        },
        'v5': {
            name: 'Peter Anderson',
            purpose: 'Emergency',
            host: 'Robert Miller',
            validUntil: '2023-06-15 18:00',
            status: 'Active'
        }
    };
    
    return visitorData[visitorId] || null;
}

/**
 * Edit visitor information
 * @param {string} visitorId - Visitor ID
 */
function editVisitor(visitorId) {
    // Get visitor data
    const visitorData = getVisitorData(visitorId);
    if (!visitorData) return;
    
    // In a real app, this would populate a form and save changes
    // For demo purposes, we'll just show an alert
    alert(`Edit visitor: ${visitorData.name}\nFeature under development.`);
}

/**
 * Delete visitor
 * @param {string} visitorId - Visitor ID
 */
function deleteVisitor(visitorId) {
    // Get visitor data
    const visitorData = getVisitorData(visitorId);
    if (!visitorData) return;
    
    // Confirm deletion
    if (confirm(`Are you sure you want to delete visitor ${visitorData.name}?`)) {
        // In a real app, this would delete from database
        // For demo purposes, we'll just remove the table row
        const visitorRow = document.querySelector(`tr[data-visitor-id="${visitorId}"]`);
        if (visitorRow) {
            visitorRow.remove();
            
            // Hide QR if this was the selected visitor
            resetVisitorQRDisplay();
            
            // Show success message
            alert('Visitor deleted successfully.');
        }
    }
}

/**
 * Reset visitor QR display to initial state
 */
function resetVisitorQRDisplay() {
    const qrContainer = document.getElementById('visitor-qr-container');
    const qrPrompt = qrContainer.querySelector('.select-visitor-prompt');
    const qrContent = qrContainer.querySelector('.visitor-qr-content');
    
    qrPrompt.classList.remove('d-none');
    qrContent.classList.add('d-none');
}

/**
 * Save new visitor
 */
function saveNewVisitor() {
    // Get form values
    const firstName = document.getElementById('visitor-firstname').value.trim();
    const lastName = document.getElementById('visitor-lastname').value.trim();
    const email = document.getElementById('visitor-email').value.trim();
    const phone = document.getElementById('visitor-phone').value.trim();
    const purpose = document.getElementById('visitor-purpose').value;
    const host = document.getElementById('visitor-host').value;
    const date = document.getElementById('visitor-date').value;
    const duration = document.getElementById('visitor-time').value;
    
    // Validate form
    if (!firstName || !lastName || !email || !phone || !purpose || !host || !date || !duration) {
        const errorElement = document.getElementById('visitor-form-error');
        errorElement.textContent = 'Please fill in all required fields.';
        errorElement.classList.remove('d-none');
        return;
    }
    
    // In a real app, this would save to database
    // For demo purposes, we'll just update the table
    
    // Create a new visitor ID
    const visitorId = 'v' + (Math.floor(Math.random() * 1000) + 10);
    
    // Get visitor table
    const visitorTable = document.getElementById('visitors-table');
    
    // Calculate validity time (current time + duration hours)
    const visitDate = new Date(date);
    const validUntil = new Date(visitDate.getTime() + parseInt(duration) * 60 * 60 * 1000);
    const formattedValidity = `${date} ${validUntil.getHours().toString().padStart(2, '0')}:${validUntil.getMinutes().toString().padStart(2, '0')}`;
    
    // Get host name
    const hostSelect = document.getElementById('visitor-host');
    const hostName = hostSelect.options[hostSelect.selectedIndex].text;
    
    // Get purpose name
    const purposeSelect = document.getElementById('visitor-purpose');
    const purposeName = purposeSelect.options[purposeSelect.selectedIndex].text;
    
    // Create new table row
    const newRow = document.createElement('tr');
    newRow.setAttribute('data-visitor-id', visitorId);
    newRow.innerHTML = `
        <td>${firstName} ${lastName}</td>
        <td><span class="badge bg-info">${purposeName}</span></td>
        <td>${hostName}</td>
        <td>${formattedValidity}</td>
        <td><span class="badge bg-success">Active</span></td>
        <td>
            <button class="btn btn-sm btn-primary view-qr" data-visitor-id="${visitorId}">
                <i class="fas fa-qrcode"></i>
            </button>
            <button class="btn btn-sm btn-outline-secondary edit-visitor" data-visitor-id="${visitorId}">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-outline-danger delete-visitor" data-visitor-id="${visitorId}">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    
    // Add to table at the top
    visitorTable.insertBefore(newRow, visitorTable.firstChild);
    
    // Add event listeners to new buttons
    newRow.querySelector('.view-qr').addEventListener('click', function() {
        showVisitorQRCode(visitorId);
    });
    
    newRow.querySelector('.edit-visitor').addEventListener('click', function() {
        editVisitor(visitorId);
    });
    
    newRow.querySelector('.delete-visitor').addEventListener('click', function() {
        deleteVisitor(visitorId);
    });
    
    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('addVisitorModal'));
    modal.hide();
    
    // Reset form
    document.getElementById('visitor-form').reset();
    document.getElementById('visitor-form-error').classList.add('d-none');
    
    // Show success alert
    alert(`Visitor ${firstName} ${lastName} added successfully.`);
}

/**
 * Print visitor QR code
 */
function printVisitorQRCode() {
    // In a real app, this would open a print dialog with QR code
    // For demo purposes, we'll just show an alert
    alert('Print functionality would be implemented here in a production environment.');
}

/**
 * Send visitor QR code by email
 */
function sendVisitorQRCodeByEmail() {
    // In a real app, this would send an email with QR code
    // For demo purposes, we'll just show an alert
    alert('Email sending functionality would be implemented here in a production environment.');
}
