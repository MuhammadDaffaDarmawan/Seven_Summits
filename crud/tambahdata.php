<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
$username = $_SESSION['username'];
include "../conn.php";
include "template/header.php";

?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Tambah Produk</h1>
  <!-- Form untuk menambah data -->
  <form action="simpan_produk.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="nama_barang">Nama Barang</label>
      <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
    </div>
    <div class="form-group">
      <label for="harga">Harga</label>
      <input type="number" class="form-control" id="harga" name="harga" required>
    </div>
    <div class="form-group">
      <label for="gambar">Gambar</label>
      <input type="file" class="form-control" id="gambar" name="gambar" required>
    </div>
    <button type="submit" name="simpanproduk" class="btn btn-primary">Submit</button>
  </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include "template/footer.php"; ?>
</div>
<!-- End of Content Wrapper -->

