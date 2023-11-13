<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "kripto02";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fungsi untuk mengenkripsi kata sandi dengan Vigenere Cipher
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

$username = $_POST["username"];
$password = $_POST["password"];

// Enkripsi password dengan Vigenere Cipher
$encryptedPassword = vigenereEncrypt($password, "PELITA");

// Cari user dengan username dan password yang sesuai di database
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$encryptedPassword'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $_SESSION["username"] = $username;
    header("Location: welcome.php"); // Redirect ke halaman selamat datang
} else {
    echo "Login failed. Username or password is incorrect.";
}

$conn->close();
?>
