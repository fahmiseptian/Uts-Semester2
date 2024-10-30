<!DOCTYPE html>
<html lang="en">

@include('assets.user.header')

<body>

    @include('assets.user.navbar')

    <!--  -->
    <div class="container my-5">
        <h2 class="mb-4">Keranjang Belanja</h2>
        <hr>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Status: <span class="badge bg-info text-dark">{{ $cart->status }}</span></h5>
            </div>
            <div class="card-body" id="cartContainer">
                <!-- Item Produk -->
                @foreach ( $cart->products as $product)
                <div class="row mb-3 align-items-center cart-item" data-product-id="15">
                    <div class="col-md-2">
                        <img src="{{ $product->image_url }}" class="img-fluid rounded" alt="{{ $product->nama_produk }}">
                    </div>
                    <div class="col-md-6">
                        <h5>{{ $product->nama_produk }}</h5>
                        <p class="text-muted mb-1">Harga Satuan: <strong>{{ 'Rp' . number_format($product->harga_satuan, 0, ',', '.') }}</strong></p>

                        <!-- Opsi Selected -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="selectedCheckbox" {{ $product->is_selected == 'yes' ?  'checked' : '' }}>
                            <label class="form-check-label" for="selectedCheckbox">Selected</label>
                        </div>

                        <!-- Kontrol Kuantitas -->
                        <div class="d-flex align-items-center mt-2">
                            <button class="btn btn-outline-secondary decreaseQty">-</button>
                            <input type="text" class="form-control text-center mx-2 qtyInput" style="width: 60px;" value="{{ $product->qty }}">
                            <button class="btn btn-outline-secondary increaseQty">+</button>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <p>Total: <strong class="totalPrice">{{ 'Rp' . number_format(($product->harga_satuan * $product->qty), 0, ',', '.') }}</strong></p>
                        <!-- Tombol Hapus Per Produk -->
                        <button class="btn btn-danger deleteProductBtn">Hapus</button>
                    </div>
                </div>
                @endforeach
                <!-- Akhir Item Produk -->

                <!-- Ringkasan -->
                <hr>
                <div class="row">
                    <div class="col-md-6 text-start">
                        <button class="btn btn-danger">Hapus Semua</button>
                    </div>
                    <div class="col-md-6 text-end">
                        <h5>Total Keranjang: <strong id="cartTotal">{{ 'Rp' . number_format($cart->total, 0, ',', '.') }}</strong></h5>
                    </div>
                </div>
                <!-- Akhir Ringkasan -->

                <!-- Tombol Lanjutkan ke Checkout -->
                <div class="text-end mt-4">
                    <button class="btn btn-primary" id="checkoutButton">Lanjutkan ke Checkout</button>
                </div>
            </div>
        </div>
    </div>

    @include('assets.user.footer')
    <script>
        $('#checkoutButton').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to continue with the checkout for this product?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/checkout';
                } else {
                    console.log('Checkout cancelled.');
                }
            });
        });
    </script>
</body>

</html>