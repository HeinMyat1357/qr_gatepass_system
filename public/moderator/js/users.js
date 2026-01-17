// Users management functionality for QR Attendance System
document.addEventListener('DOMContentLoaded', () => {
  console.log('Users management script loaded');

  checkAuthRedirect();
  setupUserSearchFilters();
  setupUserActions();
  setupBulkActions();
  setupAddUserForm();
  setupImportUsersForm();
});

// Redirect if not logged in
// function checkAuthRedirect() {
//   const user = localStorage.getItem('qr_attendance_user');
//   if (!user) window.location.href = '{{ route("moderator.login.form") }}'; // blade route
// }

// Search & filter setup
function setupUserSearchFilters() {
  const searchInput = document.getElementById('user-search');
  const searchBtn = document.getElementById('user-search-btn');
  const typeFilter = document.getElementById('user-type-filter');
  const deptFilter = document.getElementById('department-filter');
  const resetBtn = document.getElementById('reset-filters');

  searchBtn?.addEventListener('click', applyFilters);
  searchInput?.addEventListener('keypress', e => { if (e.key === 'Enter') applyFilters(); });
  typeFilter?.addEventListener('change', applyFilters);
  deptFilter?.addEventListener('change', applyFilters);
  resetBtn?.addEventListener('click', () => {
    searchInput.value = '';
    typeFilter.value = 'all';
    deptFilter.value = 'all';
    applyFilters();
  });
}

function applyFilters() {
  const rows = document.querySelectorAll('#users-table-body tr');
  const searchTerm = document.getElementById('user-search').value.toLowerCase();
  const typeVal = document.getElementById('user-type-filter').value;
  const deptVal = document.getElementById('department-filter').value.toLowerCase();

  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    const typeBadge = row.querySelector('td:nth-child(4) .badge')?.textContent.toLowerCase() || '';
    const deptText   = row.querySelector('td:nth-child(5)')?.textContent.toLowerCase() || '';
    const matches = text.includes(searchTerm)
      && (typeVal === 'all' || typeBadge === typeVal)
      && (deptVal === 'all' || deptText.includes(deptVal));

    row.classList.toggle('d-none', !matches);
  });
}

// Bind user actions (view/edit/delete)
function setupUserActions() {
  document.querySelectorAll('.view-user').forEach(btn => btn.addEventListener('click', () => alert('View User: ' + btn.dataset.userId)));
  document.querySelectorAll('.edit-user').forEach(btn => btn.addEventListener('click', () => alert('Edit User: ' + btn.dataset.userId)));
  document.querySelectorAll('.delete-user').forEach(btn => {
    btn.addEventListener('click', () => {
      if (confirm('Are you sure?')) {
        btn.closest('tr').remove();
        alert('Deleted');
      }
    });
  });
}

// Bulk action handlers
function setupBulkActions() {
  const selectAll = document.getElementById('select-all-users');
  selectAll?.addEventListener('change', () => {
    document.querySelectorAll('.user-select').forEach(cb => cb.checked = selectAll.checked);
  });

  document.getElementById('bulk-activate')?.addEventListener('click', e => {
    e.preventDefault();
    bulkUpdateStatus('Active');
  });
  document.getElementById('bulk-deactivate')?.addEventListener('click', e => {
    e.preventDefault();
    bulkUpdateStatus('Inactive');
  });
  document.getElementById('bulk-delete')?.addEventListener('click', e => {
    e.preventDefault();
    bulkDeleteSelected();
  });
}

function getSelectedRows() {
  return Array.from(document.querySelectorAll('#users-table-body .user-select'))
    .reduce((arr, cb, i) => cb.checked ? arr.concat(cb.closest('tr')) : arr, []);
}

function bulkUpdateStatus(status) {
  const rows = getSelectedRows();
  if (!rows.length) return alert('Select users first');
  if (!confirm(`Mark ${rows.length} users as ${status}?`)) return;

  rows.forEach(row => {
    const badge = row.querySelector('td:nth-child(6) .badge');
    badge.textContent = status;
    badge.className = `badge ${status === 'Active' ? 'bg-success' : 'bg-warning'}`;
  });
  clearBulkSelection();
  alert(`${rows.length} users updated`);
}

function bulkDeleteSelected() {
  const rows = getSelectedRows();
  if (!rows.length) return alert('Select users first');
  if (!confirm(`Delete ${rows.length} users? This is permanent.`)) return;
  rows.forEach(row => row.remove());
  clearBulkSelection();
  alert('Deleted');
}

function clearBulkSelection() {
  document.querySelectorAll('.user-select').forEach(cb => cb.checked = false);
  document.getElementById('select-all-users').checked = false;
}

// Add user functionality
function setupAddUserForm() {
  const saveBtn = document.getElementById('save-user');
  saveBtn?.addEventListener('click', saveNewUser);
}

function saveNewUser() {
  const first = document.getElementById('user-firstname').value.trim();
  const last  = document.getElementById('user-lastname').value.trim();
  const email = document.getElementById('user-email').value.trim();
  const phone = document.getElementById('user-phone').value.trim();
  const type  = document.getElementById('user-type').value;
  const dept  = document.getElementById('user-department').value.trim();
  const pass  = document.getElementById('user-password').value;
  const confirmPass = document.getElementById('user-confirm-password').value;
  const active = document.getElementById('user-active').checked;
  const errDiv = document.getElementById('add-user-error');

  errDiv.classList.add('d-none');

  if (!first || !last || !email || !phone || !type || !dept || !pass) {
    return showError('Please complete all required fields.');
  }
  if (pass !== confirmPass) {
    return showError('Passwords do not match.');
  }
  if (pass.length < 6) {
    return showError('Password must be at least 6 characters.');
  }

  appendUserRow(first, last, email, type, dept, active);
  $('#addUserModal').modal('hide'); // Bootstrap v5 jQuery
  document.getElementById('add-user-form').reset();
  alert(`User ${first} ${last} added`);
  
  function showError(msg) {
    errDiv.textContent = msg;
    errDiv.classList.remove('d-none');
  }
}

// Append user row in table
function appendUserRow(first, last, email, type, dept, active) {
  const tbody = document.getElementById('users-table-body');
  const row = document.createElement('tr');
  const userId = Date.now();

  row.innerHTML = `
    <td><input type="checkbox" class="form-check-input user-select"></td>
    <td>${first} ${last}</td>
    <td>${email}</td>
    <td><span class="badge ${type === 'student' ? 'bg-info' : (type === 'teacher' ? 'bg-primary' : 'bg-secondary')}">${capitalize(type)}</span></td>
    <td>${dept}</td>
    <td><span class="badge ${active ? 'bg-success' : 'bg-warning'}">${active ? 'Active' : 'Inactive'}</span></td>
    <td>
      <button class="btn btn-sm btn-outline-primary view-user" data-user-id="${userId}"><i class="fas fa-eye"></i></button>
      <button class="btn btn-sm btn-outline-secondary edit-user" data-user-id="${userId}"><i class="fas fa-edit"></i></button>
      <button class="btn btn-sm btn-outline-danger delete-user" data-user-id="${userId}"><i class="fas fa-trash"></i></button>
    </td>`;
  
  tbody.prepend(row);
  row.querySelector('.view-user').addEventListener('click', () => alert('View ' + userId));
  row.querySelector('.edit-user').addEventListener('click', () => alert('Edit ' + userId));
  row.querySelector('.delete-user').addEventListener('click', () => {
    if (confirm('Delete user?')) {
      row.remove();
      alert('Deleted');
    }
  });
}

function capitalize(s) {
  return s.charAt(0).toUpperCase() + s.slice(1);
}

// Import CSV for users
function setupImportUsersForm() {
  document.getElementById('download-template')?.addEventListener('click', e => {
    e.preventDefault();
    downloadCSVTemplate();
  });
  
  document.getElementById('start-import')?.addEventListener('click', () => simulateCSVImport());
}

function downloadCSVTemplate() {
  const content = ['FirstName,LastName,Email,Phone,Type,Department,Password', 'John,Doe,john.doe@example.com,1234567890,student,Grade 10,password123'].join('\n');
  const blob = new Blob([content], { type: 'text/csv' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url; a.download = 'user_import_template.csv';
  document.body.appendChild(a);
  a.click();
  a.remove();
}

function simulateCSVImport() {
  const fileInput = document.getElementById('import-file');
  const progressBox  = document.getElementById('import-progress-container');
  const progressBar  = document.getElementById('import-progress');
  const errDiv       = document.getElementById('import-error');
  const successDiv   = document.getElementById('import-success');

  errDiv.classList.add('d-none');
  successDiv.classList.add('d-none');

  if (!fileInput.files.length || !fileInput.files[0].name.endsWith('.csv')) {
    errDiv.textContent = 'Please select a valid CSV file.';
    errDiv.classList.remove('d-none');
    return;
  }

  progressBox.classList.remove('d-none');
  [20, 50, 80, 100].forEach((pct, i) => {
    setTimeout(() => {
      progressBar.style.width = pct + '%';
      progressBar.setAttribute('aria-valuenow', pct);
      if (pct === 100) {
        successDiv.textContent = 'Successfully imported users!';
        successDiv.classList.remove('d-none');
        ['Alice','Bob','Carol'].forEach(name => {
          const [f, l] = [name, 'Demo'];
          appendUserRow(f, l, `${name.toLowerCase()}@example.com`, 'student', 'Grade 10', true);
        });
        setTimeout(() => $('#importUsersModal').modal('hide'), 1000);
      }
    }, i * 500);
  });
}
