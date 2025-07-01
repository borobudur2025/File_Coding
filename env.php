<?php
include "koneksi.php";

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $nama = $conn->real_escape_string($_POST['name'] ?? '');
        $email = $conn->real_escape_string($_POST['email'] ?? '');
        $whatsapp = $conn->real_escape_string($_POST['whatsapp'] ?? '');

        
        $stmt = $conn->prepare("INSERT INTO user (nama, email, whatsapp) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $whatsapp);

        if ($stmt->execute()) {
            // Redirect ke Google Drive setelah berhasil
            header("Location: https://drive.google.com/drive/folders/1ifs1ZRoKwwbwSbuZ-j7_l6ATynmmfu7s?usp=drive_link");
            exit();
        } else {
            throw new Exception("Gagal menyimpan data: " . $stmt->error);
        }
        
        $stmt->close();
    }
} catch (Exception $e) {
    echo "<script>
        alert('Error: ".$e->getMessage()."');
        window.history.back();
        </script>";
} finally {
    $conn->close();
}
?>