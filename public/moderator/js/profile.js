// Profile management functionality for QR Attendance System

document.addEventListener('DOMContentLoaded', function() {
    console.log('Profile script loaded');
    
    // Check if user is logged in
    // const user = localStorage.getItem('qr_attendance_user');
    // if (!user) {
    //     // Redirect to login if not logged in
    //     window.location.href = 'login.html';
    //     return;
    // }
    
    // Load user data and initialize forms
    loadUserProfile();
    setupProfileForm();
    setupPasswordForm();
    setupPreferencesForm();
    setupLogoutAction();
});

/**
 * Load user profile data and update UI
 */
function loadUserProfile() {
    const userDataStr = localStorage.getItem('qr_attendance_user');
    if (!userDataStr) return;
    
    const userData = JSON.parse(userDataStr);
    
    // Update profile header
    document.getElementById('profile-fullname').textContent = `${userData.firstName} ${userData.lastName}`;
    document.getElementById('profile-email').textContent = userData.email;
    document.getElementById('profile-type').textContent = userData.userType.charAt(0).toUpperCase() + userData.userType.slice(1);
    
    // Set user type badge color
    const userTypeElement = document.getElementById('profile-type');
    if (userTypeElement) {
        if (userData.userType === 'student') {
            userTypeElement.className = 'badge bg-info me-2';
        } else if (userData.userType === 'teacher') {
            userTypeElement.className = 'badge bg-primary me-2';
        } else if (userData.userType === 'staff') {
            userTypeElement.className = 'badge bg-secondary me-2';
        }
    }
    
    // Populate profile form fields
    document.getElementById('profile-firstname').value = userData.firstName;
    document.getElementById('profile-lastname').value = userData.lastName;
    document.getElementById('profile-email-input').value = userData.email;
    document.getElementById('profile-phone').value = userData.phone || '';
    
    // Set profile avatar with initials
    const initials = userData.firstName.charAt(0) + userData.lastName.charAt(0);
    const profileAvatar = document.getElementById('profile-avatar-initials');
    if (profileAvatar) {
        profileAvatar.textContent = initials;
        
        // Set avatar background color based on user type
        if (userData.userType === 'student') {
            profileAvatar.style.backgroundColor = '#0dcaf0'; // info color
        } else if (userData.userType === 'teacher') {
            profileAvatar.style.backgroundColor = '#0d6efd'; // primary color
        } else if (userData.userType === 'staff') {
            profileAvatar.style.backgroundColor = '#6c757d'; // secondary color
        }
    }
}

/**
 * Set up profile form submission
 */
function setupProfileForm() {
    const profileForm = document.getElementById('profile-form');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            updateProfileInfo();
        });
    }
    
    // Avatar upload handler
    const avatarInput = document.getElementById('avatar-upload');
    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            uploadProfileAvatar(e);
        });
    }
}

/**
 * Set up password change form
 */
function setupPasswordForm() {
    const passwordForm = document.getElementById('password-form');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            updatePassword();
        });
    }
}

/**
 * Set up preferences form
 */
function setupPreferencesForm() {
    const preferencesForm = document.getElementById('preferences-form');
    if (preferencesForm) {
        preferencesForm.addEventListener('submit', function(e) {
            e.preventDefault();
            updatePreferences();
        });
    }
}

/**
 * Setup logout button action
 */
function setupLogoutAction() {
    const logoutBtn = document.getElementById('logout-button');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            logout();
        });
    }
}

/**
 * Upload profile avatar image
 * @param {Event} event - File input change event
 */
function uploadProfileAvatar(event) {
    const file = event.target.files[0];
    
    if (!file) return;
    
    // Validate file type
    if (!file.type.match('image.*')) {
        alert('Please select an image file.');
        return;
    }
    
    // Validate file size (max 2 MB)
    if (file.size > 2 * 1024 * 1024) {
        alert('Image size should not exceed 2 MB.');
        return;
    }
    
    // Read and display the file
    const reader = new FileReader();
    reader.onload = function(e) {
        // Update avatar preview with the new image
        const profileAvatarImg = document.getElementById('profile-avatar-img');
        const profileAvatarInitials = document.getElementById('profile-avatar-initials');
        
        if (profileAvatarImg) {
            profileAvatarImg.src = e.target.result;
            profileAvatarImg.classList.remove('d-none');
            
            if (profileAvatarInitials) {
                profileAvatarInitials.classList.add('d-none');
            }
        }
    };
    reader.readAsDataURL(file);
    
    // Show save button
    document.getElementById('save-avatar-button').classList.remove('d-none');
}

/**
 * Update profile information
 */
function updateProfileInfo() {
    // Get form values
    const firstName = document.getElementById('profile-firstname').value.trim();
    const lastName = document.getElementById('profile-lastname').value.trim();
    const email = document.getElementById('profile-email-input').value.trim();
    const phone = document.getElementById('profile-phone').value.trim();
    
    // Get existing user data
    const userDataStr = localStorage.getItem('qr_attendance_user');
    if (!userDataStr) return;
    
    const userData = JSON.parse(userDataStr);
    
    // Validate form
    const errorElement = document.getElementById('profile-error');
    const successElement = document.getElementById('profile-success');
    
    errorElement.classList.add('d-none');
    successElement.classList.add('d-none');
    
    if (!firstName || !lastName || !email) {
        errorElement.textContent = 'Please fill in all required fields.';
        errorElement.classList.remove('d-none');
        return;
    }
    
    // Update user data
    userData.firstName = firstName;
    userData.lastName = lastName;
    userData.email = email;
    userData.phone = phone;
    
    // Save updated data
    localStorage.setItem('qr_attendance_user', JSON.stringify(userData));
    
    // Update UI
    document.getElementById('profile-fullname').textContent = `${firstName} ${lastName}`;
    document.getElementById('profile-email').textContent = email;
    
    // Update avatar initials
    const initials = firstName.charAt(0) + lastName.charAt(0);
    const profileAvatarInitials = document.getElementById('profile-avatar-initials');
    if (profileAvatarInitials) {
        profileAvatarInitials.textContent = initials;
    }
    
    // Show success message
    successElement.textContent = 'Profile updated successfully.';
    successElement.classList.remove('d-none');
    
    // Hide success message after 5 seconds
    setTimeout(() => {
        successElement.classList.add('d-none');
    }, 5000);
}

/**
 * Update password
 */
function updatePassword() {
    // Get form values
    const currentPassword = document.getElementById('current-password').value;
    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    
    // Validate form
    const errorElement = document.getElementById('password-error');
    const successElement = document.getElementById('password-success');
    
    errorElement.classList.add('d-none');
    successElement.classList.add('d-none');
    
    if (!currentPassword || !newPassword || !confirmPassword) {
        errorElement.textContent = 'Please fill in all password fields.';
        errorElement.classList.remove('d-none');
        return;
    }
    
    if (newPassword !== confirmPassword) {
        errorElement.textContent = 'New passwords do not match.';
        errorElement.classList.remove('d-none');
        return;
    }
    
    if (newPassword.length < 6) {
        errorElement.textContent = 'New password must be at least 6 characters long.';
        errorElement.classList.remove('d-none');
        return;
    }
    
    // In a real app, this would verify the current password and update with the new one
    // For demo purposes, we'll just simulate success
    
    // Check demo password
    if (currentPassword !== 'password123') {
        errorElement.textContent = 'Current password is incorrect.';
        errorElement.classList.remove('d-none');
        return;
    }
    
    // Show success message
    successElement.textContent = 'Password updated successfully.';
    successElement.classList.remove('d-none');
    
    // Reset form
    document.getElementById('password-form').reset();
    
    // Hide success message after 5 seconds
    setTimeout(() => {
        successElement.classList.add('d-none');
    }, 5000);
}

/**
 * Update user preferences
 */
function updatePreferences() {
    // Get form values
    const emailNotifications = document.getElementById('email-notifications').checked;
    const smsNotifications = document.getElementById('sms-notifications').checked;
    const language = document.getElementById('language-preference').value;
    const theme = document.getElementById('theme-preference').value;
    
    // Get existing user data
    const userDataStr = localStorage.getItem('qr_attendance_user');
    if (!userDataStr) return;
    
    const userData = JSON.parse(userDataStr);
    
    // Add preferences to user data
    userData.preferences = {
        emailNotifications,
        smsNotifications,
        language,
        theme
    };
    
    // Save updated data
    localStorage.setItem('qr_attendance_user', JSON.stringify(userData));
    
    // Show success message
    const successElement = document.getElementById('preferences-success');
    successElement.classList.remove('d-none');
    
    // Hide success message after 5 seconds
    setTimeout(() => {
        successElement.classList.add('d-none');
    }, 5000);
    
    // If theme was changed, simulate applying it
    if (theme === 'dark') {
        alert('Dark mode would be applied in a real application.');
    }
}

/**
 * Log out the current user
 */
function logout() {
    if (confirm('Are you sure you want to log out?')) {
        // Remove user data from local storage
        localStorage.removeItem('qr_attendance_user');
        
        // Redirect to login page
        window.location.href = 'login.html';
    }
}
