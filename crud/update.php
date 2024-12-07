<?php
include "../conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];

    // Menghandle upload gambar
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "image/";
        $target_file = $target_dir . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

        // Menghapus gambar lama
        $query = $conn->prepare("SELECT gambar FROM produk WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $data = $query->fetch();
        if ($data && file_exists("image/" . $data['gambar'])) {
            unlink("image/" . $data['gambar']);
        }

        // Update dengan gambar baru
        $query = $conn->prepare("UPDATE produk SET gambar = :gambar, nama_barang = :nama_barang, harga = :harga WHERE id = :id");
        $query->bindParam(':gambar', $gambar);
    } else {
        // Update tanpa mengganti gambar
        $query = $conn->prepare("UPDATE produk SET nama_barang = :nama_barang, harga = :harga WHERE id = :id");
    }

    $query->bindParam(':nama_barang', $nama_barang);
    $query->bindParam(':harga', $harga);
    $query->bindParam(':id', $id);

    if ($query->execute()) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Gagal mengupdate data.";
    }
    header("Location: lihatdata.php"); // Ganti dengan file utama Anda
} else {
    echo "Invalid request.";
}
?>