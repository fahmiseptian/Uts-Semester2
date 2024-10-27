<!-- Bootstrap core JavaScript-->
<script src="{{ asset('styles/js/jquery/jquery.js') }}"></script>
<script src="{{ asset('styles/js/bootstrap/bootstrap.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('styles/js/jquery/easing.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('styles/js/sb-admin.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('styles/js/chart/chart.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('styles/js/chart/area.js') }}"></script>
<script src="{{ asset('styles/js/chart/pie.js') }}"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
