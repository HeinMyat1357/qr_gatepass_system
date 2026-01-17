// Attendance scanning functionality for QR Attendance System

// document.addEventListener('DOMContentLoaded', function() {
//     console.log('Attendance scanning script loaded');
    
//     // Check if user is logged in
//     const user = localStorage.getItem('qr_attendance_user');
//     if (!user) {
//         // Redirect to login if not logged in
//         window.location.href = 'login.html';
//         return;
//     }
    
//     // Initialize scanner if on scan page
//     const videoElement = document.getElementById('qr-video');
//     if (videoElement) {
//         initQRScanner();
//     }
    
//     // Set up scan result handling
//     setupScanResultHandling();
// });

/**
 * Initialize QR code scanner
 */
async function initQRScanner() {
    const video = document.getElementById('qr-video');
    const scannerMessage = document.getElementById('scanner-message');
    const scannerStatus = document.getElementById('scanner-status');
    
    if (!video) return;
    
    try {
        // Access camera with getUserMedia API
        const stream = await navigator.mediaDevices.getUserMedia({ 
            video: { facingMode: 'environment' } 
        });
        
        video.srcObject = stream;
        video.setAttribute('playsinline', true); // Required for iOS Safari
        await video.play();
        
        // Update status
        scannerStatus.textContent = 'Ready';
        scannerStatus.className = 'badge bg-success';
        scannerMessage.textContent = 'Point the camera at a QR code to scan';
        
        // Start scanning using a polyfill or library
        // Note: In a real implementation, we would use a library like jsQR
        // This is a placeholder for demonstration
        startQRDecoding(video);
        
    } catch (err) {
        console.error('Error accessing camera:', err);
        scannerStatus.textContent = 'Error';
        scannerStatus.className = 'badge bg-danger';
        scannerMessage.textContent = 'Could not access camera. Please make sure you have given camera permission.';
    }
}

/**
 * Start QR code decoding from video feed
 * @param {HTMLVideoElement} videoElement - Video element
 */
function startQRDecoding(videoElement) {
    // Normally, we would use a library like jsQR
    // For demonstration, we'll simulate a scan after a few seconds
    
    setTimeout(() => {
        // Simulate a successful scan
        const scanData = {
            userId: 'user_123456',
            name: 'John Doe',
            userType: 'student',
            timestamp: new Date().toISOString()
        };
        
        handleSuccessfulScan(scanData);
    }, 5000);
}

/**
 * Handle a successful QR code scan
 * @param {Object} scanData - Data from the scanned QR code
 */
function handleSuccessfulScan(scanData) {
    const scanResults = document.getElementById('scan-results');
    const scannerMessage = document.getElementById('scanner-message');
    
    if (!scanResults || !scannerMessage) return;
    
    // Show the results section
    scanResults.classList.remove('d-none');
    
    // Update message
    scannerMessage.textContent = 'QR Code successfully scanned!';
    
    // Update user info in results
    document.getElementById('scanned-user-name').textContent = scanData.name;
    document.getElementById('scanned-user-type').textContent = scanData.userType;
    document.getElementById('scanned-timestamp').textContent = new Date().toLocaleTimeString();
    
    // Play success sound
    const successSound = document.getElementById('success-sound');
    if (successSound) {
        successSound.play().catch(e => console.log('Error playing sound:', e));
    }
    
    // Record the attendance in localStorage for demo
    recordAttendance(scanData);
}

/**
 * Record attendance data
 * @param {Object} scanData - Attendance data
 */
function recordAttendance(scanData) {
    // In a real app, this would be sent to a server
    // For demo purposes, we'll store in localStorage
    
    const attendanceRecords = JSON.parse(localStorage.getItem('qr_attendance_records') || '[]');
    
    // Add new record
    attendanceRecords.push({
        userId: scanData.userId,
        name: scanData.name,
        userType: scanData.userType,
        location: 'Main Entrance', // Would be dynamic in a real app
        timestamp: new Date().toISOString(),
        action: 'check-in'
    });
    
    // Save back to localStorage
    localStorage.setItem('qr_attendance_records', JSON.stringify(attendanceRecords));
}

/**
 * Set up handlers for scan result actions
 */
function setupScanResultHandling() {
    // Reset scanner button
    const resetScannerBtn = document.getElementById('reset-scanner');
    if (resetScannerBtn) {
        resetScannerBtn.addEventListener('click', function() {
            const scanResults = document.getElementById('scan-results');
            if (scanResults) {
                scanResults.classList.add('d-none');
            }
            
            const scannerMessage = document.getElementById('scanner-message');
            if (scannerMessage) {
                scannerMessage.textContent = 'Point the camera at a QR code to scan';
            }
        });
    }
    
    // Record attendance button
    const recordAttendanceBtn = document.getElementById('record-attendance');
    if (recordAttendanceBtn) {
        recordAttendanceBtn.addEventListener('click', function() {
            const scanResults = document.getElementById('scan-results');
            const scanSuccess = document.getElementById('scan-success');
            
            if (scanResults && scanSuccess) {
                scanResults.classList.add('d-none');
                scanSuccess.classList.remove('d-none');
                
                // Hide success message after a delay
                setTimeout(() => {
                    scanSuccess.classList.add('d-none');
                    
                    // Reset scanner message
                    const scannerMessage = document.getElementById('scanner-message');
                    if (scannerMessage) {
                        scannerMessage.textContent = 'Point the camera at a QR code to scan';
                    }
                }, 3000);
            }
        });
    }
}
