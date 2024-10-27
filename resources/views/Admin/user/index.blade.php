<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
        </div>

        <div class="card-body">
            <button class="btn btn-info btn-user" id="addUser" style="margin-bottom: 30px;">Tambah</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Access</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Access</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->access }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-primary btn-sm" onclick="editUser({{ $user->id }})">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>

                                    @if ($user->status == 'active')
                                        <!-- Delete Button -->
                                        <button class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('Admin.user.modal')

@include('assets.admin.footer')
<script>
    function refresh(parameters) {
        var url = '/admin/user';
        // Load content via AJAX
        $.ajax({
            url: url,
            method: 'GET',
            success: function(data) {
                $('.loading-overlay').hide();
                $('#content-page').html(
                    data); // Insert response data into #content-page
            },
            error: function() {
                $('#content-page').html(
                    '<p>Error loading content.</p>'); // Error handling
            }
        });
    }

    $("#addUser").click(function() {
        $('#addUserModal').modal('show');
    });

    $('#addUserForm').on('submit', function(event) {
        event.preventDefault();
        $('.loading-overlay').show();
        // Gather form data
        var formData = {
            name: $('#userName').val(),
            email: $('#userEmail').val(),
            password: $('#password').val(),
            username: $('#username').val(),
            access: $('#userAccess').val(),
            status: $('#userStatus').val()
        };

        // AJAX request
        $.ajax({
            url: '/api/admin/create-user', // Replace with your API endpoint
            type: 'POST',
            data: formData,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'User added successfully!',
                    text: 'The user has been added to the system.',
                    confirmButtonText: 'OK'
                });
                $('#addUserModal').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error('Error adding user:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error adding user',
                    text: 'Failed to add user. Please try again.',
                    confirmButtonText: 'OK'
                });
            },
            complete: function() {
                $('.loading-overlay').hide();
                refresh();
            }
        });
    });

    function editUser(id) {
        $('.loading-overlay').show();
        $.ajax({
            url: '/api/admin/get-user', // Replace with your API endpoint
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                $('#EditUserModal').modal('show');
                // Populate the form fields with the user data from the response
                $('#idUser').val(response.user.id);
                $('#EdituserName').val(response.user.name);
                $('#Editusername').val(response.user.username);
                $('#EdituserEmail').val(response.user.email);
                $('#EdituserAccess').val(response.user.access);
                $('#EdituserStatus').val(response.user.status);
                $('#Editpassword').closest('.form-group').remove();
            },
            error: function(xhr, status, error) {
                console.error('Error getting user data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error Getting User Data',
                    text: 'Failed to get user data. Please try again.',
                    confirmButtonText: 'OK'
                });
            },
            complete: function() {
                $('.loading-overlay').hide();
            }
        });
    }

    function deleteUser(id) {
        $('.loading-overlay').show();
        $.ajax({
            url: '/api/admin/delete-user', // Replace with your API endpoint
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'User update successfully!',
                    text: 'The user has been update to the system.',
                    confirmButtonText: 'OK'
                });
            },
            error: function(xhr, status, error) {
                console.error('Error delete user data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error Delete User ',
                    text: 'Failed to delete user. Please try again.',
                    confirmButtonText: 'OK'
                });
            },
            complete: function() {
                $('.loading-overlay').hide();
                refresh();
            }
        });
    }

    $('#editUserForm').on('submit', function(event) {
        event.preventDefault();
        $('.loading-overlay').show();
        // Gather form data
        var formData = {
            id: $('#idUser').val(),
            name: $('#EdituserName').val(),
            email: $('#EdituserEmail').val(),
            username: $('#Editusername').val(),
            access: $('#EdituserAccess').val(),
            status: $('#EdituserStatus').val()
        };

        // AJAX request
        $.ajax({
            url: '/api/admin/update-user', // Replace with your API endpoint
            type: 'POST',
            data: formData,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'User update successfully!',
                    text: 'The user has been update to the system.',
                    confirmButtonText: 'OK'
                });
                $('#EditUserModal').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error('Error adding user:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error update user',
                    text: 'Failed to update user. Please try again.',
                    confirmButtonText: 'OK'
                });
            },
            complete: function() {
                $('.loading-overlay').hide();
                refresh();
            }
        });
    });
</script>
