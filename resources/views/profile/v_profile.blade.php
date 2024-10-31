<style>
    .form-control[disabled] {
        background-color: #e9ecef;
    }
</style>

<h2 class="mb-4">Profile</h2>

<!-- Input fields for profile information -->
<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" value="{{ $user->name }}" disabled>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
</div>
<div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" value="{{ $user->username }}" disabled>
</div>

<!-- Button for changing password -->
<button class="btn btn-secondary " onclick="changePassword()">Change Password</button>

<!-- Button to toggle edit and save mode -->
<button id="editButton" class="btn btn-primary" >Edit data profile</button>
<script>
    // Toggle edit mode for profile input fields
    $('#editButton').on('click', function() {
        const isDisabled = $('#name').prop('disabled');

        if (isDisabled) {
            // Switch to edit mode
            $('#name, #email, #username').prop('disabled', false);
            $(this).text('Save');
        } else {
            // Switch to save mode
            $('#name, #email, #username').prop('disabled', true);
            $(this).text('Edit');

            // Collect data and send AJAX request
            const name = $('#name').val();
            const email = $('#email').val();
            const username = $('#username').val();

            $.ajax({
                url: '/profile/update-profile', // Ganti URL dengan endpoint server Anda
                method: 'POST',
                data: {
                    name: name,
                    email: email,
                    username: username
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Profile updated successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update profile. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });

    // Placeholder function for change password action
    function changePassword(params) {
        alert('open change password modal.');
    }
</script>