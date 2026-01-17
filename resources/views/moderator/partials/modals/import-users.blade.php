<!-- Import Users Modal -->
<div class="modal fade" id="importUsersModal" tabindex="-1" aria-labelledby="importUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="importUsersModalLabel">
                    <i class="fas fa-file-import me-2"></i>Import Users
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Upload a CSV file with user data. The file should have the following headers:</p>
                <code>FirstName,LastName,Email,Phone,Type,Department,Password</code>

                <p class="mt-3 mb-3">
                    You can <a href="#" id="download-template">download a template</a> to get started.
                </p>

                <div class="mb-3">
                    <label for="import-file" class="form-label">Choose CSV File</label>
                    <input class="form-control" type="file" id="import-file" accept=".csv">
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="import-header-row" checked>
                    <label class="form-check-label" for="import-header-row">
                        File includes header row
                    </label>
                </div>

                <!-- Progress bar -->
                <div class="progress d-none" id="import-progress-container">
                    <div class="progress-bar" id="import-progress" role="progressbar" style="width: 0%"
                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <!-- Alert Messages -->
                <div class="alert alert-danger d-none mt-3" id="import-error"></div>
                <div class="alert alert-success d-none mt-3" id="import-success"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="start-import">
                    <i class="fas fa-upload me-1"></i>Start Import
                </button>
            </div>
        </div>
    </div>
</div>
