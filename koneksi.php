<?php
function encryptVigenere($text, $key) {
    $keyLength = strlen($key);
    $encryptedText = "";

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        $keyChar = $key[$i % $keyLength];

        // Enkripsi karakter
        $encryptedText .= chr((ord($char) + ord($keyChar)) % 256);
    }

    return $encryptedText;
}

// Informasi koneksi database
$servername = "localhost";
$username = "nama_pengguna";
$password = "kata_sandi";
$database = "nama_database";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Data yang akan disimpan ke database (contoh: username dan password)
$username = "pengguna";
$password = "sandi_rahasia";

// Kunci untuk enkripsi Vigenere
$key = "kuncirahasia";

// Enkripsi data sebelum disimpan ke database
$encryptedUsername = encryptVigenere($username, $key);
$encryptedPassword = encryptVigenere($password, $key);

// Menyimpan data ke dalam database
$sql = "INSERT INTO users (username, password) VALUES ('$encryptedUsername', '$encryptedPassword')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
