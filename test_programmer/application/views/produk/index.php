<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>
<body>
    <div class="container">
        <h1>Daftar Produk</h1>

            <div class="button-container">
                <a href="<?= site_url('produk/tambah') ?>" class="btn-tambah">Tambah Produk</a>
                
                <div class="filter-buttons">
                <a href="<?= site_url('produk/index') ?>" class="btn-filter <?= ($filter_status == '') ? 'active' : '' ?>">Semua Produk</a>
                <a href="<?= site_url('produk/index?status=1') ?>" class="btn-filter <?= ($filter_status == '1') ? 'active' : '' ?>">Bisa Dijual</a>
                </div>
            </div>


        <table class="table-produk">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Kelola</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($produk_list as $produk): ?>
                <tr>
                    <td><?= $produk->nama_produk ?></td>
                    <td><?= $produk->nama_kategori ?></td>
                    <td>Rp <?= number_format($produk->harga, 0, ',', '.') ?></td>
                    <td><?= $produk->nama_status ?></td>
                    <td>
                        <div class="action-buttons">
                        <a href="<?= site_url('produk/edit/'.$produk->id_produk) ?>" class="btn-edit">Edit</a>
                        <a href="<?= site_url('produk/hapus/'.$produk->id_produk) ?>" class="btn-hapus" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</body>
</html>
