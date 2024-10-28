<!-- Modal untuk Tambah Produk -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <img id="imagePreview" src="#" alt="Preview Gambar" style="display: none; max-width: 100%; height: auto; margin-top: 10px;">
                        <hr>
                        <label for="productImage">Upload Gambar</label>
                        <input type="file" class="form-control-file" id="productImage" name="gambar" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="productName">Nama Produk</label>
                        <input type="text" class="form-control" id="productName" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="productStock">Stok</label>
                        <input type="number" class="form-control" id="productStock" name="stok" required>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="productPrice">Harga</label>
                            <input type="text" class="form-control" id="productPrice" name="harga" required oninput="formatRupiah(this)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="productCategory">Kategori</label>
                        <input type="text" class="form-control" id="productCategory" name="kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="productStatus">Status</label>
                        <select class="form-control" id="productStatus" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>