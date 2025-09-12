// Function to toggle the dropdown menu
function toggleDropdown(id) {
    document.querySelectorAll('[id$="Dropdown"], #profileMenu').forEach(dropdown => {
        if (dropdown.id !== id) {
            dropdown.classList.add('hidden');
            dropdown.classList.remove('dropdown-show');
        }
    });

    const target = document.getElementById(id);
    if (target.classList.contains('hidden')) {
        target.classList.remove('hidden');
        setTimeout(() => target.classList.add('dropdown-show'), 10); // delay to trigger transition
    } else {
        target.classList.remove('dropdown-show');
        setTimeout(() => target.classList.add('hidden'), 300);
    }
}

// Function to close dropdowns when clicking outside
window.addEventListener('click', function (e) {
    if (
        !e.target.closest('button') &&
        !e.target.closest('.relative')
    ) {
        document.querySelectorAll('[id$="Dropdown"], #profileMenu').forEach(dropdown => {
            dropdown.classList.remove('dropdown-show');
            setTimeout(() => dropdown.classList.add('hidden'), 300);
        });
    }
});

// Function to toggle the password visibility
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordInput.placeholder = 'Enter password';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordInput.placeholder = 'Enter password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}

// Function to toggle the tire form visibility
function toggleForm() {
    document.getElementById("tireForm").classList.toggle("hidden");
}

// Function to handle the search input and filter the table
function filterTable(tableId, inputId) {
    const input = document.getElementById(inputId);
    const filter = input.value.toLowerCase();
    const table = document.getElementById(tableId);
    const trs = table.getElementsByTagName('tr');
    for (let i = 1; i < trs.length; i++) { // skip header row
        let tds = trs[i].getElementsByTagName('td');
        let show = false;
        for (let j = 0; j < tds.length; j++) { // check all columns
            if (tds[j] && tds[j].textContent.toLowerCase().indexOf(filter) > -1) {
                show = true;
                break;
            }
        }
        trs[i].style.display = show ? '' : 'none';
    }
}

    
