
// Get the dashboard link element
const dashboardLink = document.querySelector('.dashboard-link');
const userLink = document.querySelector('.user-link');
const inventoryLink = document.querySelector('.inventory-link');
const notificationLink = document.querySelector('.notification-link');

// Get the dash element
const dash = document.querySelector('.dash');
const user = document.querySelector('.user');
const inv = document.querySelector('.inv');
const noti = document.querySelector('.noti');

// Add click event listener to the dashboard link
dashboardLink.addEventListener('click', function(event) {
    event.preventDefault();
    dash.style.display = 'block';
    user.style.display = 'none';
    inv.style.display = 'none';
    noti.style.display = 'none';
    userLink.classList.remove('active')
    notificationLink.classList.remove('active')
    inventoryLink.classList.remove('active')
    this.classList.toggle('active');
});

userLink.addEventListener('click', function(event) {
    event.preventDefault();
    user.style.display = 'block';
    dash.style.display = 'none';
    inv.style.display = 'none';
    noti.style.display = 'none';
    dashboardLink.classList.remove('active')
    notificationLink.classList.remove('active')
    inventoryLink.classList.remove('active')
    this.classList.toggle('active');
});

inventoryLink.addEventListener('click', function(event) {
    event.preventDefault();
    inv.style.display = 'block';
    dash.style.display = 'none';
    user.style.display = 'none';
    noti.style.display = 'none';
    dashboardLink.classList.remove('active')
    notificationLink.classList.remove('active')
    userLink.classList.remove('active')
    this.classList.toggle('active');
});
notificationLink.addEventListener('click', function(event) {
    event.preventDefault();
    noti.style.display = 'block';
    dash.style.display = 'none';
    inv.style.display = 'none';
    user.style.display = 'none';
    
    dashboardLink.classList.remove('active')
    inventoryLink.classList.remove('active')
    userLink.classList.remove('active')
    this.classList.toggle('active');
});

document.addEventListener('DOMContentLoaded', function() {
    const addInventoryButton = document.querySelector('.btn_add');
    const addInventoryForm = document.querySelector('.add-inventory-form');
    const addInventorySubmit = document.querySelector('.submit_btn');
    const overlay = document.querySelector('.overlay');
    const cross = document.querySelector('.cross');

    addInventoryButton.addEventListener('click', function() {
        addInventoryForm.style.display = addInventoryForm.style.display === 'block' ? 'none' : 'block';
        overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';

    });
    addInventorySubmit.addEventListener('click', function() {
        addInventoryForm.style.display = addInventoryForm.style.display === 'block' ? 'none' : 'block';
        overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
    });
    cross.addEventListener('click', function() {
        addInventoryForm.style.display = addInventoryForm.style.display === 'block' ? 'none' : 'block';
        overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const formSections = document.querySelectorAll('.form-section');

    typeSelect.addEventListener('change', function() {
        const selectedType = this.value;

        formSections.forEach(section => {
            section.style.display = 'none';
        });

        const selectedFormSection = document.getElementById(selectedType + 'Form');
        if (selectedFormSection) {
            selectedFormSection.style.display = 'block';
        }
    });
});