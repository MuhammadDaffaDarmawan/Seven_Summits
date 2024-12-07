<?php
include "../conn.php";

if (isset($_POST['simpanproduk'])) {
    // Menyiapkan query untuk menyimpan data
    $query = "INSERT INTO produk (nama_barang, harga, gambar) VALUES (:nama_barang, :harga, :gambar)";

    // Menyiapkan statement PDO
    $statement = $conn->prepare($query);

    // Bind parameter ke nilai aktual
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar']['name']; // Get the name of the uploaded file

    // Move uploaded file to desired location (optional)
    $target_directory = "image/"; // Directory where you want to store uploaded files
    $target_file = $target_directory . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

    // Bind parameter ke statement
    $statement->bindParam(':nama_barang', $nama_barang);
    $statement->bindParam(':harga', $harga);
    $statement->bindParam(':gambar', $gambar);

    // Eksekusi statement untuk menyimpan data
    try {
        $statement->execute();
        // echo "Data berhasil disimpan.";
        header('Location: lihatdata.php');
    } catch (PDOException $e) {
        die("Gagal menyimpan data: " . $e->getMessage());
    }
}
?>