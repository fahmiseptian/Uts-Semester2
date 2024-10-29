<!DOCTYPE html>
<html lang="en">

@include('assets.admin.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('assets.admin.side-bar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('assets.admin.nav-bar')

                <!-- Begin Page Content -->
                <div class="container-fluid" id="content-page">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4" id="page-heading">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('assets.admin.copyright')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <i class="fas fa-angle-up"></i>
    </a>
    <a class="scroll-to-top rounded" href="#page-top">

        @include('Admin.home.modal')

        @include('assets.admin.footer')

        <script>
            $(document).ready(function() {
                // Toggle sidebar
                $('#sidebarCollapse').on('click', function() {
                    console.log('masok');

                    $('#sidebar').toggleClass('active');
                });

                // Load content into #content-page
                $('.load-content').on('click', function(event) {
                    $('.loading-overlay').show();
                    event.preventDefault(); // Prevent default link behavior
                    var url = $(this).attr('href'); // Get the URL from href attribute
                    console.log(url);

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
                });

                $('.nav-link').on('click', function(event) {
                    var url = $(this).attr('href');
                    event.preventDefault();
                    if (url == '#') {
                        return;
                    }
                    $('.loading-overlay').show();
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
                });
            });
        </script>
</body>

</html>