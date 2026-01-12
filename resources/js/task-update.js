import axios from "axios";

document.addEventListener('DOMContentLoaded', () => {
    // 1. Toggle Edit Mode
    document.querySelectorAll('.edit-toggle-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const container = e.target.closest('.task-container');
            container.querySelector('.task-display').classList.add('hidden');
            container.querySelector('.task-edit-form').classList.remove('hidden');
        });
    });

    // 2. Cancel Edit Mode
    document.querySelectorAll('.cancel-edit-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const container = e.target.closest('.task-container');
            container.querySelector('.task-display').classList.remove('hidden');
            container.querySelector('.task-edit-form').classList.add('hidden');
        });
    });

    // 3. Handle Form Submission (Save Button)
    document.querySelectorAll('.task-edit-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            axios.patch(this.action, data)
                .then(() => window.location.reload())
                .catch(err => console.error(err));
        });
    });

    // 4. Handle Auto-Submit for Checkbox (Marking as complete)
    document.querySelectorAll('.task-auto-submit').forEach(checkbox => {
        checkbox.addEventListener('change', (e) => {
            const container = e.target.closest('.task-container');
            const taskId = container.dataset.taskId;
            // Since the checkbox might be outside the actual form now, 
            // we send a standalone request
            axios.patch(`/tasks/${taskId}/toggle`, { // You may need to adjust this route
                is_complete: e.target.checked
            }).then(() => window.location.reload());
        });
    });

    // Add this to your task-update.js
    document.querySelectorAll('.task-status-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const url = this.getAttribute('data-url');
            const isCompleted = this.checked ? 1 : 0;

            // Send just the completion status to the server
            axios.patch(url, {
                is_complete: isCompleted,
                // We send the existing body so validation doesn't fail
                body: this.closest('.task-container').querySelector('p').innerText 
            })
            .then(res => {
                // Optional: You can reload or just toggle a CSS class for the "line-through"
                window.location.reload(); 
            })
            .catch(err => {
                console.error('Failed to update status', err);
                // Revert the checkbox if the server fails
                this.checked = !this.checked;
            });
        });
    });
});
