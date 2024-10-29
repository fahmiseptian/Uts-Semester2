<footer class="text-light mt-5" id="footer-user">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4">
                <h5>Tentang Kami</h5>
                <p>Kami adalah platform e-commerce fashion yang menyediakan berbagai produk berkualitas, mulai dari pakaian hingga aksesori, dengan harga terbaik. Temukan gaya favorit Anda dan nikmati pengalaman belanja yang menyenangkan!</p>
            </div>
            <div class="col-md-4">
                <h5>Tautan Penting</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light">Beranda</a></li>
                    <li><a href="#" class="text-light">Produk</a></li>
                    <li><a href="#" class="text-light">Tentang Kami</a></li>
                    <li><a href="#" class="text-light">Kontak</a></li>
                    <li><a href="#" class="text-light">Syarat & Ketentuan</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Ikuti Kami</h5>
                <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-center">
            <p class="mb-0">© 2024 Lalana-store. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('active');
    }
</script>
<script>
    $('#loginForm').on('submit', function(event) {
        event.preventDefault(); // Mencegah form dari pengiriman default

        // Mengambil nilai input
        var email = $('#email').val();
        var password = $('#password').val();

        // Mengirim data menggunakan AJAX
        $.ajax({
            url: '/login', // Replace with your actual login URL
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                if (response.success) {
                    window.location.href = '/'; // Replace with your dashboard URL
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