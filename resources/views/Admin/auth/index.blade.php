<!DOCTYPE html>
<html lang="en">

@include('assets.admin.header')

<body id="page-top">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <img src="{{ asset('img/logo-store.png') }}" alt="logo-lalana" style="margin-left: 40px">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" id="loginForm">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email"
                                            aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="#">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include('Admin.home.modal')

    @include('assets.admin.footer')
    <script>
        $('#loginForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get the input values
            var email = $('#email').val();
            var password = $('#password').val();

            // Perform the AJAX request
            $.ajax({
                url: '/admin/store-login', // Replace with your actual login URL
                type: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = '/admin'; // Replace with your dashboard URL
                    } else {
                        // Show an error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Login error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred during login. Please try again.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
</body>

</html>
