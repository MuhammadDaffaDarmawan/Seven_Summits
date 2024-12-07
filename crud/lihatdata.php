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


<script>
    function confirmdeletion(id) {
        if (confirm("Apakah Anda yakin ingin menghapus item ini?")) {
            window.location.href = "delete.php?id=" + id;
        }
    }
</script>

<br>

<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Lihat Produk</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = $conn->prepare("SELECT * FROM produk ORDER BY id DESC");
            $query->execute();
            while ($data = $query->fetch()) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><img src="image/<?php echo $data['gambar'] ?>" style="width: 150px; height: 150px;"></td>
                    <td><?php echo $data['nama_barang'] ?></td>
                    <td><?php echo $data['harga'] ?></td>
                    <td>
                        <button type="button" class="btn btn-primary"
                            onclick="window.location.href='edit.php?id=<?php echo $data['id'] ?>'"><i
                                class="fa-solid fa-pen"></i>Edit</button>
                        <button type="button" class="btn btn-danger" onclick="confirmdeletion(<?php echo $data['id'] ?>)"><i
                                class="fa-solid fa-trash-can"></i>Hapus</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include "template/footer.php"; ?>
</div>
<!-- End of Main Content -->

</div>
End of Content Wrapper