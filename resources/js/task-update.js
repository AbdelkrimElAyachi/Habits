import axios from "axios"

// check or uncheck task
document.querySelectorAll('#task-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', e => {
        // update task
        updateTask(e)

    })
})

// when hit enter from task input, Update
document.querySelectorAll('#taskUpdateForm input[type="text"]').forEach(input => {
    input.addEventListener('keydown', e => {
        // when press enter
        if(e.key === 'Enter') {
            // prevent reload when the user hit enter
            e.preventDefault()
            // update task
            updateTask(e)
        }

    })
})

// reusable utils function
function updateTask(e) {
    const form = e.currentTarget.closest('form')
    const formData = new FormData(form)

    const data = Object.fromEntries(formData.entries())

    // form has @method('PATCH) => _method="PATCH"  so it's typically patch request,
    axios.post(form.action, data).then(res => {
        if(res.status === 200) {
            location.reload()
        }
    })
}

// attach to all inline task update forms (they share id 'taskUpdateForm')
document.querySelectorAll('form#taskUpdateForm').forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const action = form.getAttribute('action');

        const bodyEl = form.querySelector('input[name="body"]');
        const isCompleteEl = form.querySelector('input[name="is_complete"]');
        const dueAtEl = form.querySelector('input[name="due_at"]');

        const payload = {
            body: bodyEl ? bodyEl.value : '',
            // send boolean as 1/0 or true/false depending on backend
            is_complete: isCompleteEl ? (isCompleteEl.checked ? 1 : 0) : undefined,
            due_at: dueAtEl ? dueAtEl.value : null,
        };

        axios.patch(action, payload)
            .then(() => {
                // refresh to reflect updated due_at in the list
                window.location.reload();
            })
            .catch(err => {
                console.error('Failed to update task', err);
                // optionally show feedback to user
            });
    });
});

// keep compatibility: if forms are updated via checkbox clicks, also handle change on checkbox
document.querySelectorAll('form#taskUpdateForm input[name="is_complete"]').forEach(cb => {
    cb.addEventListener('change', function (e) {
        const form = e.currentTarget.closest('form');
        if (form) form.dispatchEvent(new Event('submit', { cancelable: true }));
    });
});
