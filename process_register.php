<?php
// Koneksi ke database
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "kripto02";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fungsi untuk mengenkripsi kata sandi dengan Vigenere Cipher (atau enkripsi sesuai kebutuhan)
function vigenereEncrypt($text, $key) {
    $text = strtoupper($text);
    $key = strtoupper($key);
    $result = "";

    for ($i = 0; $i < strlen($text); $i++) {
        $char = ord($text[$i]) + (ord($key[$i % strlen($key)]) - 65);
        if ($char > 90) {
            $char -= 26;
        }
        $result .= chr($char);
    }

    return $result;
}

// Ambil data dari formulir pendaftaran
$username = $_POST["username"];
$password = $_POST["password"];

// Enkripsi password dengan Vigenere Cipher (atau enkripsi sesuai kebutuhan)
$encryptedPassword = vigenereEncrypt($password, "PELITA");

// Cek apakah username sudah ada
$checkUsernameQuery = "SELECT username FROM users WHERE username = ?";
$stmtCheckUsername = $conn->prepare($checkUsernameQuery);
$stmtCheckUsername->bind_param("s", $username);
$stmtCheckUsername->execute();
$stmtCheckUsername->store_result();

if ($stmtCheckUsername->num_rows > 0) {
    echo "Error: Username '$username' sudah digunakan. Pilih username lain.";
} else {
    // Simpan data ke database
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

    // Persiapkan statement dengan parameter
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $encryptedPassword);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$stmtCheckUsername->close();
$conn->close();
?>
