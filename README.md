
## Profil
| #               | Biodata                  |
| --------------- | --------------------     |
| **Nama**        | Muhamad Suryanegara      |
| **NIM**         | 312110447                |
| **Kelas**       | TI.21.A.1                |
| **Mata Kuliah** | Pemrograman Mobile 2     |


Proses pembuatan
Vigenère Cipher adalah suatu metode enkripsi klasik yang menggunakan polialfabetik substitution cipher, yaitu penggantian setiap karakter plainteks dengan karakter yang berbeda berdasarkan suatu kunci.
Langkah-langkah pembuatan Vigenère Cipher:
Ini adalah halaman program saya :

![image](https://github.com/Muhamadsuryanegara/Implementasi-enkripsi-Vigen-re-Cipher/assets/92678339/564722f7-eeb4-4289-b8a0-b7491d62e879)

Key yang digunakan pada project ini yaitu “Pelita”

```/ Enkripsi password dengan Vigenere Cipher (atau enkripsi sesuai kebutuhan)
$encryptedPassword = vigenereEncrypt($password, "PELITA");

Password yang diambil dari formulir dienkripsi menggunakan fungsi Vigenere Cipher dengan kunci "PELITA". Enkripsi ini digunakan untuk mencocokkan dengan data yang ada di database.
function vigenereEncrypt($text, $key) {
// . . . 
}
Fungsi ini digunakan untuk mengenkripsi kata sandi menggunakan metode Vigenere Cipher. Setiap karakter dalam kata sandi diubah menjadi karakter terenkripsi menggunakan rumus Vigenere Cipher. Hasil enkripsi dikembalikan oleh fungsi.

$username = $_POST["username"];
$password = $_POST["password"];
Mengambil nilai username dan password dari formulir login yang dikirimkan melalui metode POST.

// Cek apakah username sudah ada
$checkUsernameQuery = "SELECT username FROM users WHERE username = ?";
$stmtCheckUsername = $conn->prepare($checkUsernameQuery);
$stmtCheckUsername->bind_param("s", $username);
$stmtCheckUsername->execute();
$stmtCheckUsername->store_result();

if ($stmtCheckUsername->num_rows > 0) {
    echo "Error: Username '$username' sudah digunakan. Pilih username lain.";
} else {
Mengeksekusi query untuk memeriksa apakah username yang diinputkan sudah ada dalam database. Jika sudah ada, program memberikan pesan kesalahan. Jika belum, program melanjutkan proses.
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
Menutup koneksi ke database setelah operasi query selesai.Menyiapkan dan menjalankan query untuk menyimpan data pengguna ke dalam tabel 'users'. Menggunakan prepared statement dengan parameter untuk mencegah SQL injection. Memberikan pesan kesuksesan atau kesalahan sesuai hasil eksekusi query.
 	$stmtCheckUsername->close();
$conn->close();
?>
Menutup statement dan koneksi ke database setelah selesai melakukan operasi query.
```

Berikut tampilan halaman register:

![image](https://github.com/Muhamadsuryanegara/Implementasi-enkripsi-Vigen-re-Cipher/assets/92678339/cf340138-ac7d-4786-b3f4-3385b1caa5b2)










daftar berhasil maka pada database password akan langsung terekripsi XRQWKMPXTST  berikut tampilan pada databasenya : 

![image](https://github.com/Muhamadsuryanegara/Implementasi-enkripsi-Vigen-re-Cipher/assets/92678339/dffb589f-254c-4a89-9ee0-7a2ad5f0e207)









Untuk membuktikan bahwa password terseut sudah terenkripsi vignere maka bisa kita cek 
menggunakan website https://cryptii.com/ berikut hasil setelelah di cek :


![image](https://github.com/Muhamadsuryanegara/Implementasi-enkripsi-Vigen-re-Cipher/assets/92678339/c46bae0b-b737-4480-b433-a141eef5cad1)



	


Kita daftar terlebih dahulu register berikut tampilanya :

![image](https://github.com/Muhamadsuryanegara/Implementasi-enkripsi-Vigen-re-Cipher/assets/92678339/240a5e9a-ec03-46a8-877e-65a8b28da8bd)












Namun Jika Login terdapat  kesamaan username atau sudah digunakan, maka login tidak berhasil (Error).


![image](https://github.com/Muhamadsuryanegara/Implementasi-enkripsi-Vigen-re-Cipher/assets/92678339/7df148ab-3d2a-4ea2-89a1-96f94880bda5)



Jika pentaftaran berhasill dilakukan maka user akan di arahkan ke halaman login berikut :


![image](https://github.com/Muhamadsuryanegara/Implementasi-enkripsi-Vigen-re-Cipher/assets/92678339/91c9a5a0-4a8c-4bac-815f-1c169d33633e)








#Berikut source code dari program tersebut :
Register html	
```
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" action="process_register.php">
        <h2>Register</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>


Login html
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" action="process_login.php">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
```


Untuk lebih lengkapnya untuk sorce code :
https://github.com/Muhamadsuryanegara/Implementasi-enkripsi-Vigen-re-Cipher.git

```
