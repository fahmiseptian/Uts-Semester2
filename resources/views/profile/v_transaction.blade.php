<style>
    .product-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 5px;
    }

    .transaction-item {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
    }
</style>

<h2 class="mb-4">Transaction List</h2>

<!-- Transaction Item -->
@foreach ($data as $d)
<div class="transaction-item">
    <div class="d-flex justify-content-between">
        <!-- Invoice Info -->
        <div>
            <p><strong>Invoice No:</strong> INV-{{ $d->invoice }}</p>
            <p><strong>Total:</strong> {{ 'Rp ' . number_format($d->total, 0, ',', '.') }}</p>
        </div>

        <!-- Status -->
        <div>
            <p><strong>Status:</strong> <span class="badge bg-{{ $d->status == 'finished' ? 'success' : 'warning'}}">{{ ucfirst($d->status) }}</span></p>
        </div>

        <!-- Detail Button -->
        <div>
            <button class="btn btn-primary" onclick="showDetails('{{ $d->id }}')">Details</button>
        </div>
    </div>

    <!-- Product List -->
    <div class="product-list mt-3">
        <h6>Products:</h6>
        @foreach ($d->products as $product)
        <div class="d-flex align-items-center mb-2">
            <img src="{{ $product->image_url }}" alt="{{ $product->nama_produk }}" class="product-img me-3">
            <div>
                <p class="mb-0">{{ $product->nama_produk }} - {{ 'Rp ' . number_format($product->harga_satuan, 0, ',', '.') }}</p>
                <small class="text-muted">Quantity: {{ $product->qty }}</small>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach