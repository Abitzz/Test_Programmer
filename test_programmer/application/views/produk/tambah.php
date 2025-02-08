<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>
<body>
    <div class="form-container">
        <h1>Tambah Produk</h1>

        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <form action="<?= site_url('produk/tambah') ?>" method="post" onsubmit="return validateForm()" class="form-table">
            <div class="form-row">
                <label for="nama_produk">Nama Produk:</label>
                <input type="text" id="nama_produk" name="nama_produk" value="<?= set_value('nama_produk'); ?>">
                <?= form_error('nama_produk', '<small class="error">', '</small>'); ?>
            </div>

            <div class="form-row">
                <label for="harga">Harga:</label>
                <input type="text" id="harga" name="harga" value="<?= set_value('harga'); ?>">
                <?= form_error('harga', '<small class="error">', '</small>'); ?>
            </div>

            <div class="form-row">
                <label for="id_kategori">Kategori:</label>
                <select name="id_kategori" id="id_kategori" class="select-status">
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($kategori_list as $kategori): ?>
                        <option value="<?= $kategori->id_kategori ?>" <?= isset($produk) && $produk->id_kategori == $kategori->id_kategori ? 'selected' : ''; ?>>
                            <?= $kategori->nama_kategori ?>
                        </option>
                    <?php endforeach; ?>
                    <option value="new">+ Tambah Kategori Baru</option>
                </select>
            </div>

            <div class="form-row" id="kategori-baru-row" style="display: none;">
                <label for="nama_kategori">Kategori Baru:</label>
                <input type="text" id="nama_kategori" name="nama_kategori">
            </div>

            <script>
                document.getElementById('id_kategori').addEventListener('change', function() {
                    let kategoriBaruRow = document.getElementById('kategori-baru-row');
                    if (this.value === 'new') {
                        kategoriBaruRow.style.display = 'block';
                    } else {
                        kategoriBaruRow.style.display = 'none';
                    }
                });
            </script>

            <div class="form-row">
                <label for="status">Status:</label>
                <select name="status" id="status" class="select-status">
                    <option value="1">Bisa Dijual</option>
                    <option value="2">Tidak Bisa Dijual</option>
                </select>
            </div>

            <div class="form-row">
                <button type="submit" class="btn-simpan">Simpan</button>
                <a href="<?= site_url('produk') ?>" class="btn-kembali">Kembali</a>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            let nama = document.getElementById("nama_produk").value.trim();
            let harga = document.getElementById("harga").value.trim();

            if (nama === "") {
                alert("Nama produk tidak boleh kosong!");
                return false;
            }
            if (harga === "") {
                alert("Harga produk tidak boleh kosong!");
                return false;
            }
            if (isNaN(harga)) {
                alert("Harga harus berupa angka!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
