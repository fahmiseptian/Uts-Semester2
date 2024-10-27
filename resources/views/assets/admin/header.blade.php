<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('styles/css/font.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- Custom styles for this template-->
    <link href="{{ asset('styles/css/sb-admin.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
            backdrop-filter: blur(5px);
            /* Blur effect */
            /* Hide initially */
            z-index: 999;
            /* Make sure it's on top of other content */
            display: flex;
            /* Enable flexbox */
            justify-content: center;
            /* Center the loader horizontally */
            align-items: center;
            /* Center the loader vertically */
        }

        .loader {
            width: 90px;
            height: 14px;
            --c: #fff 92%, #0000;
            background: radial-gradient(circle closest-side, var(--c)) calc(100%/-4) 0,
                radial-gradient(circle closest-side, var(--c)) calc(100%/4) 0;
            background-size: calc(100%/2) 100%;
            animation: l14 1.5s infinite;
        }

        @keyframes l14 {
            0% {
                background-position: calc(100%/-4) 0, calc(100%/4) 0;
            }

            50% {
                background-position: calc(100%/-4) -14px, calc(100%/4) 14px;
            }

            100% {
                background-position: calc(100%/4) -14px, calc(3*100%/4) 14px;
            }
        }
    </style>
</head>

<!-- Loader HTML -->
<div class="loading-overlay" style="display: none;">
    <div class="loader"></div>
</div>
