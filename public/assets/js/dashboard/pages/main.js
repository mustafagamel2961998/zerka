  document.addEventListener('DOMContentLoaded', function () {
    const deleteModalElement = document.getElementById('deleteModal');
    if (!deleteModalElement) return; 
    
    const deleteModal = new bootstrap.Modal(deleteModalElement);
    const deleteForm = document.getElementById('modal-delete-form');
    const countryNameSpan = document.getElementById('name-span');

    document.addEventListener('click', function (event) {
        const button = event.target.closest('.open-delete-modal');
        
        if (button) {
            event.preventDefault();

            const deleteUrl = button.getAttribute('data-url');
            const countryName = button.getAttribute('data-name');

            deleteForm.setAttribute('action', deleteUrl);
            countryNameSpan.textContent = countryName;

            deleteModal.show();
        }
    });
});