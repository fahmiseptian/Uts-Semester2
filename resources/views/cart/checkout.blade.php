<!DOCTYPE html>
<html lang="en">

@include('assets.user.header')
<style>
    .checkout-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        max-width: 80px;
        border-radius: 8px;
    }

    .total-summary {
        font-size: 1.2em;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #4CAF50;
        border: none;
    }

    .btn-primary:hover {
        background-color: #45a049;
    }

    .payment-option {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .payment-option .form-check {
        flex: 1;
    }
</style>

<body>

    @include('assets.user.navbar')

    <div class="checkout-container">
        <div class="row g-4">
            <!-- Shipping Address and Payment Method -->
            <div class="col-lg-7">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Shipping Address</h5>
                    </div>
                    <div class="card-body">
                        <form id="checkoutForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Recipient Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Full Name">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" rows="2" placeholder="Full Address"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" placeholder="City">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="postalCode" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="postalCode" placeholder="Postal Code">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="number" class="form-control" id="phone" placeholder="Phone Number">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Payment Method</h5>
                    </div>
                    <div class="card-body">
                        <div class="payment-option">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="transfer" name="paymentMethod" id="bankTransfer" checked>
                                <label class="form-check-label" for="bankTransfer">Bank Transfer</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="credit_cart" name="paymentMethod" id="creditCard">
                                <label class="form-check-label" for="creditCard">Credit Card</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="e-wallet" name="paymentMethod" id="eWallet">
                                <label class="form-check-label" for="eWallet">E-Wallet</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Summary and Prices -->
            <div class="col-lg-5">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Purchase Summary</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($cart->detail as $detail )
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{$detail->image_url}}" class="product-image me-3" alt="{{$detail->nama_produk}}">
                            <div>
                                <h6>{{$detail->nama_produk}}</h6>
                                <p class="text-muted mb-0">{{ 'Rp' . number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                                <p class="text-muted">Quantity: {{$detail->qty}}</p>
                            </div>
                        </div>
                        @endforeach
                        <!-- Total -->
                        <hr>
                        <div class="d-flex justify-content-between total-summary">
                            <span>Total Price ({{$cart->total_qty}} Items):</span>
                            <span>{{ 'Rp' . number_format($cart->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Confirm Payment Button -->
                <div class="text-end">
                    <button class="btn btn-primary btn-lg" id="confirmButton">Confirm and Pay</button>
                </div>
            </div>
        </div>
    </div>

    @include('assets.user.footer')

    <script>
        $('#confirmButton').on('click', function() {
            // Validate input fields
            const name = $('#name').val().trim();
            const address = $('#address').val().trim();
            const city = $('#city').val().trim();
            const postalCode = $('#postalCode').val().trim();
            const phone = $('#phone').val().trim();

            if (!name || !address || !city || !postalCode || !phone) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please fill in all fields.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Create data object
            const data = {
                name: name,
                address: address,
                city: city,
                postalCode: postalCode,
                phone: phone,
                paymentMethod: $('input[name="paymentMethod"]:checked').val()
            };

            // AJAX call to your server endpoint
            $.ajax({
                url: '/checkout/finished',
                method: 'POST',
                data: data,
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Please transfer to the bank.\nBank Name: XYZ Bank\nAccount Number: 123-456-7890',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Notice!',
                                text: 'We will verify and process your purchase shortly.',
                                icon: 'info',
                                confirmButtonText: 'OK'
                            });
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/';
                        }
                    })
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
</body>

</html>