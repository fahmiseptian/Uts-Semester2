<!DOCTYPE html>
<html lang="en">

@include('assets.user.header')

<style>
    .profile-container {
        margin: 40px;
        margin-left: 5px;
        /* display: flex; */
        flex-wrap: wrap;
        padding: 0;
    }

    .sidebar {
        min-width: 200px;
        max-width: 250px;
        background-color: #007bff;
        color: white;
        padding: 20px 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 15px;
    }

    .sidebar button {
        width: 100%;
        padding: 10px 20px;
        text-align: left;
        background: none;
        color: inherit;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    .sidebar button.active {
        background-color: #0056b3;
    }

    .submenu {
        display: none;
        margin-left: 20px;
        flex-direction: column;
    }

    .submenu button {
        font-size: 14px;
        padding: 5px 20px;
        background: #0056b3;
    }

    .submenu button.active {
        background-color: #004080;
    }

    .content {
        flex: 1;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        margin-top: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Logo Style */
    .logo-menu {
        display: none;
        cursor: pointer;
        margin-bottom: 20px;
    }

    /* Responsive Styles */
    @media (max-width: 767px) {
        .sidebar {
            display: none;
            /* Hide sidebar on mobile */
        }

        .logo-menu {
            display: block;
            /* Show logo menu on mobile */
        }

        .submenu {
            display: flex;
            flex-direction: column;
            margin-left: 0;
            /* Align submenu without margin on mobile */
        }
    }
</style>

<body>

    @include('assets.user.navbar')

    <div class="container-fluid profile-container">
        <!-- Logo Menu for Mobile -->
        <div class="logo-menu text-center" onclick="toggleSidebar()">
            <span class="material-icons" style="font-size: 48px;">menu</span>
        </div>

        <!-- Sidebar Menu -->
        <div class="sidebar col-12 col-md-4 col-lg-3 mb-3 mb-md-0">
            <button id="btn-profile" class="active" onclick="loadContent('profile')">
                <span class="material-icons">person</span> Profile
            </button>
            <button id="btn-transactions" onclick="toggleSubMenu('transactions')">
                <span class="material-icons">receipt_long</span> Transactions
            </button>

            <!-- Submenu for Transactions -->
            <div id="submenu-transactions" class="submenu ms-2">
                <button onclick="loadContent('all')">
                    <span class="material-icons">list</span> All
                </button>
                <button onclick="loadContent('in_process')">
                    <span class="material-icons">hourglass_top</span> In Process
                </button>
                <button onclick="loadContent('checking')">
                    <span class="material-icons">check_circle</span> Checking
                </button>
                <button onclick="loadContent('completed')">
                    <span class="material-icons">done_all</span> Completed
                </button>
            </div>

            <button id="btn-logout" onclick="loadContent('logout')">
                <span class="material-icons">logout</span> Logout
            </button>
        </div>

        <!-- Content Area -->
        <div id="profile-content" class="content col-12 col-md-8 col-lg-9">
            <!-- Default content loaded via AJAX -->
        </div>
    </div>

    @include('assets.user.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function loadContent(section) {
            // Set active class for menu items and handle submenu display
            document.querySelectorAll('.sidebar button').forEach(button => button.classList.remove('active'));
            document.querySelectorAll('.submenu button').forEach(button => button.classList.remove('active'));

            if (section === 'profile' || section === 'logout') {
                document.getElementById(`btn-${section}`).classList.add('active');
                document.getElementById('submenu-transactions').style.display = 'none';
            } else {
                document.getElementById('btn-transactions').classList.add('active');
                document.getElementById('submenu-transactions').style.display = 'flex';
                document.querySelector(`#submenu-transactions button[onclick="loadContent('${section}')"]`).classList.add('active');
            }

            // AJAX call to load the content
            $.ajax({
                url: `/get-content/${section}`,
                method: 'GET',
                success: function(response) {
                    $('#profile-content').html(response);
                },
                error: function() {
                    $('#profile-content').html('<p>Error loading content. Please try again.</p>');
                }
            });
        }

        // Toggle visibility of submenu for Transactions
        function toggleSubMenu(menuId) {
            const submenu = document.getElementById(`submenu-${menuId}`);
            submenu.style.display = submenu.style.display === 'flex' ? 'none' : 'flex';

            // Automatically load the default submenu content if toggled open
            if (submenu.style.display === 'flex') {
                loadContent('all');
            }
        }

        // Toggle the sidebar menu on mobile
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = sidebar.style.display === 'none' || sidebar.style.display === '' ? 'flex' : 'none';
        }

        // Load default content
        loadContent('profile');
    </script>
</body>

</html>