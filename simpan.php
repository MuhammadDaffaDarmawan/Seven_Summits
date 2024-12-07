<?php
    include "conn.php";
    include "helper.php";

    if (isset($_POST['simpan'])) {
    // Menyiapkan query untuk menyimpan data
$query = "INSERT INTO pesan (nama, email, asal_kota, pesan) VALUES (:nama, :email, :asal_kota, :pesan)";

// Menyiapkan statement PDO
$statement = $conn->prepare($query);

// Bind parameter ke nilai aktual
$nama = $_POST['nama']; // Misalnya, nilai1 diambil dari form
$email = $_POST['email']; // Misalnya, nilai2 diambil dari form
$asal_kota = $_POST['asal_kota']; // Misalnya, nilai3 diambil dari form
$pesan = $_POST['pesan']; // Misalnya, nilai3 diambil dari form

// Bind parameter ke statement
$statement->bindParam(':nama', $nama);
$statement->bindParam(':email', $email);
$statement->bindParam(':asal_kota', $asal_kota);
$statement->bindParam(':pesan', $pesan);

// Eksekusi statement untuk menyimpan data
try {
    $statement->execute();
    // echo "Data berhasil disimpan.";
    header('Location: https://wa.me/' . $nomor_wa . '/?text=Hallo%20' . $nama);
} catch (PDOException $e) {
    die("Gagal menyimpan data: " . $e->getMessage());
}
    }
?>

