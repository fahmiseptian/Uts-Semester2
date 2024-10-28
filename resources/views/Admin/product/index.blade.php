<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Products</h6>
        </div>

        <div class="card-body">
            <button class="btn btn-info btn-user" id="addProducts" style="margin-bottom: 30px;">Tambah</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Stok</th>
                            <th>Price</th>
                            <th>Categoty</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Stok</th>
                            <th>Price</th>
                            <th>Categoty</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ $product->getFirstMediaUrl('product') }}" alt="Product Image" style="width: 0px; height: 70px; object-fit: cover;">
                            </td>
                            <td>{{ $product->nama }}</td>
                            <td>{{ $product->stok }}</td>
                            <td>{{ 'Rp' . number_format($product->harga, 0, ',', '.') }}</td>
                            <td>{{ $product->kategori }}</td>
                            <td>{{ $product->status }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('Admin.product.modal')
@include('assets.admin.footer')
<script>
    function formatRupiah(input) {
        let value = input.value.replace(/\D/g, ''); // Hapus karakter non-digit
        value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(value); // Format ke Rupiah
        input.value = value.replace(/,00$/, ''); // Hapus desimal ",00" jika tidak diperlukan
    }

    function refresh(parameters) {
        $('.loading-overlay').show();
        var url = '/admin/product';
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

    $('#addProducts').click(function() {
        $('#productModal').modal('show');
    });

    // Preview gambar sebelum diunggah
    $('#productImage').change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#imagePreview').attr('src', e.target.result).show(); // Tampilkan preview gambar
        };
        reader.readAsDataURL(this.files[0]); // Baca file yang diunggah
    });

    // Mengirim data melalui AJAX saat form disubmit
    $('#addProductForm').submit(function(event) {
        event.preventDefault();

        // Hilangkan format Rupiah pada harga sebelum dikirim
        let rawHarga = $('#productPrice').val().replace(/[^0-9]/g, ''); // Ambil angka saja
        $('#productPrice').val(rawHarga);

        // Lanjutkan dengan form data dan AJAX seperti sebelumnya
        var formData = new FormData(this);
        $.ajax({
            url: '/api/admin/store-product',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#productModal').modal('hide');
                $('#addProductForm')[0].reset();
                $('#imagePreview').hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Add Product Success',
                    text: 'Successfully added product',
                    confirmButtonText: 'OK'
                });
                refresh();
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Add Product Failed',
                    text: error,
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>