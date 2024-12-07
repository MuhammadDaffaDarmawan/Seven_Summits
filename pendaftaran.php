<?php
include "conn.php"; // Sertakan file koneksi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $asal_kota = $_POST["asal_kota"];
    $pesan = $_POST["pesan"];

    try {
        $sql = "INSERT INTO pesan (nama, email, asal_kota, pesan) VALUES (:nama, :email, :asal_kota, :pesan)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':asal_kota', $asal_kota);
        $stmt->bindParam(':pesan', $pesan);
        $stmt->execute();

        // Redirect ke halaman lain atau halaman yang sama setelah 2 detik
        header("refresh:2;url=index.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null; // Tutup koneksi setelah selesai
?>