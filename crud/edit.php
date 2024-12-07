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


<div class="container">
    <h2>Edit Produk</h2>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = $conn->prepare("SELECT * FROM produk WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $data = $query->fetch();
        if ($data) {
            ?>
            <form action="update.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <div class="form-group">
                    <label for="nama_barang">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                        value="<?php echo $data['nama_barang']; ?>">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $data['harga']; ?>">
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar">
                    <br>
                    <img src="image/<?php echo $data['gambar'] ?>" style="width: 150px; height: 150px;">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            <?php
        } else {
            echo "Data tidak ditemukan!";
        }
    } else {
        echo "ID tidak ditemukan!";
    }
    ?>
</div>

<?php include "template/footer.php"; ?>
</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->