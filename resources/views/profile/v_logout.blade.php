<style>
    .logout-box {
        padding: 20px;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .logout-box h4 {
        margin-bottom: 15px;
    }
</style>

<div class="logout-box">
    <h4>Are you sure you want to logout?</h4>
    <p class="text-muted">You will be returned to the home screen.</p>
    <div class="d-flex justify-content-center mt-4">
        <button class="btn btn-danger me-2" id="logout-btn">Logout</button>
    </div>
</div>

<script>
    document.getElementById('logout-btn').addEventListener('click', function() {
        window.location.href = "{{ route('logout') }}";
    });
</script>