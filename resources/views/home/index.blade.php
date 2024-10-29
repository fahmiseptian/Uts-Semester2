<!DOCTYPE html>
<html lang="en">

@include('assets.user.header')

<body>

    @include('assets.user.navbar')

    <section class="container mt-4">
        <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/banner-1.png') }}" class="d-block w-100 home-banner" alt="Promo 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/banner-2.png') }}" class="d-block w-100 home-banner" alt="Promo 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/banner-3.png') }}" class="d-block w-100 home-banner" alt="Promo 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="container mt-4 " id="cotainer-category">
        <h5 style="margin-bottom: 20px;">Kategori Pilihan</h5>
        <hr>
        <div class="d-flex justify-content-between">
            <div class="text-center mx-2">
                <img src="{{ asset('img/k-wanita.png') }}" class="rounded mb-2 logo-category" alt="Category 1">
                <p>Fashion Wanita</p>
            </div>
            <div class="text-center mx-2">
                <img src="{{ asset('img/k-pria.png') }}" class="rounded mb-2 logo-category" alt="Category 2">
                <p>Fashion Pria</p>
            </div>
            <div class="text-center mx-2">
                <img src="{{ asset('img/k-anak.png') }}" class=" logo-category" alt="Category 3">
                <p>Fashion Anak-anak</p>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <div class="trending-container mb-4">
            <h2 class="trending-title">Lagi trending, nih</h2>
            <div class="load-more">
                Muat Lainnya
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                    <path
                        d="M8 1.5a.5.5 0 0 1 .5.5v3.09l1.646-1.646a.5.5 0 0 1 .708.708l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5a.5.5 0 0 1 .708-.708L7.5 5.09V2a.5.5 0 0 1 .5-.5z" />
                </svg>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-md-4 col-lg-3 mb-3">
                <div class="product-card-trend">
                    <img src="https://images.tokopedia.net/img/cache/200/attachment/2018/8/9/3127195/3127195_76d08c44-8194-4454-9fb0-1e7a64b656aa.jpg.webp"
                        alt="Kopi Kapal Api" class="product-image-trend">
                    <div>
                        <p class="product-name-trend">Gtx 1660 Super</p>
                        <p class="product-quantity-trend">11rb produk</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3">
                <div class="product-card-trend">
                    <img src="https://images.tokopedia.net/img/cache/200/attachment/2018/8/9/3127195/3127195_76d08c44-8194-4454-9fb0-1e7a64b656aa.jpg.webp"
                        alt="Kopi Kapal Api" class="product-image-trend">
                    <div>
                        <p class="product-name-trend">Gtx 1660 Super</p>
                        <p class="product-quantity-trend">11rb produk</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3">
                <div class="product-card-trend">
                    <img src="https://images.tokopedia.net/img/cache/200/attachment/2018/8/9/3127195/3127195_76d08c44-8194-4454-9fb0-1e7a64b656aa.jpg.webp"
                        alt="Kopi Kapal Api" class="product-image-trend">
                    <div>
                        <p class="product-name-trend">Gtx 1660 Super</p>
                        <p class="product-quantity-trend">11rb produk</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3">
                <div class="product-card-trend">
                    <img src="https://images.tokopedia.net/img/cache/200/attachment/2018/8/9/3127195/3127195_76d08c44-8194-4454-9fb0-1e7a64b656aa.jpg.webp"
                        alt="Kopi Kapal Api" class="product-image-trend">
                    <div>
                        <p class="product-name-trend">Gtx 1660 Super</p>
                        <p class="product-quantity-trend">11rb produk</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3">
                <div class="product-card-trend">
                    <img src="https://images.tokopedia.net/img/cache/200/attachment/2018/8/9/3127195/3127195_76d08c44-8194-4454-9fb0-1e7a64b656aa.jpg.webp"
                        alt="Kopi Kapal Api" class="product-image-trend">
                    <div>
                        <p class="product-name-trend">Gtx 1660 Super</p>
                        <p class="product-quantity-trend">11rb produk</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3">
                <div class="product-card-trend">
                    <img src="https://images.tokopedia.net/img/cache/200/attachment/2018/8/9/3127195/3127195_76d08c44-8194-4454-9fb0-1e7a64b656aa.jpg.webp"
                        alt="Kopi Kapal Api" class="product-image-trend">
                    <div>
                        <p class="product-name-trend">Gtx 1660 Super</p>
                        <p class="product-quantity-trend">11rb produk</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3">
                <div class="product-card-trend">
                    <img src="https://images.tokopedia.net/img/cache/200/attachment/2018/8/9/3127195/3127195_76d08c44-8194-4454-9fb0-1e7a64b656aa.jpg.webp"
                        alt="Kopi Kapal Api" class="product-image-trend">
                    <div>
                        <p class="product-name-trend">Gtx 1660 Super</p>
                        <p class="product-quantity-trend">11rb produk</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3">
                <div class="product-card-trend">
                    <img src="https://images.tokopedia.net/img/cache/200/attachment/2018/8/9/3127195/3127195_76d08c44-8194-4454-9fb0-1e7a64b656aa.jpg.webp"
                        alt="Kopi Kapal Api" class="product-image-trend">
                    <div>
                        <p class="product-name-trend">Gtx 1660 Super</p>
                        <p class="product-quantity-trend">11rb produk</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product List Section -->
    <section class="container mt-4">
        <h5>Produk Terbaru</h5>
        <hr>
        <div class="row">
            @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100">
                    <img src="{{ $product->getFirstMediaUrl('product') }}" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->nama }}</h6>
                        <p class="card-text text-muted">{{ 'Rp' . number_format($product->harga, 0, ',', '.') }}</p>
                        <div class="button-group w-100 mt-2">
                            <a href="#" class="btn-detail">Detail</a>
                            <a href="#" class="btn-cart" title="Tambah ke Keranjang" data-id="{{ $product->id }}">
                                <span class="material-icons">add_shopping_cart</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    @include('home.modal')
    @include('assets.user.footer')
    <script>
        $('.btn-cart').on('click', function(e) {
            e.preventDefault(); // Mencegah aksi default link

            var productId = $(this).data('id');

            $.ajax({
                url: '/addCart',
                type: 'POST',
                data: {
                    id_product: productId,
                    qty: 1,
                },
                xhrFields: {
                    withCredentials: true // Include cookies with the request
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Produk berhasil ditambahkan ke keranjang!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal menambahkan produk ke keranjang: ' + response.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Terjadi kesalahan!',
                        text: 'Kesalahan: ' + error,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
</body>

</html>