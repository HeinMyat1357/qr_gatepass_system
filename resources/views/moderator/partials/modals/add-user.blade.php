<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addUserModalLabel"><i class="fas fa-user-plus me-2"></i>Add New User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-user-form">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="user-firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="user-firstname" required>
                        </div>
                        <div class="col-md-6">
                            <label for="user-lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="user-lastname" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="user-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="user-email" required>
                    </div>
                    <div class="mb-3">
                        <label for="user-phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="user-phone" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="user-type" class="form-label">User Type</label>
                            <select class="form-select" id="user-type" required>
                                <option disabled selected>Select type</option>
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="user-department" class="form-label">Department</label>
                            <input type="text" class="form-control" id="user-department" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="user-password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="user-password" required>
                        </div>
                        <div class="col-md-6">
                            <label for="user-confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="user-confirm-password" required>
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="user-active" checked>
                        <label class="form-check-label" for="user-active">Active</label>
                    </div>
                    <div class="alert alert-danger d-none" id="add-user-error"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="save-user">Save User</button>
            </div>
        </div>
    </div>
</div>
