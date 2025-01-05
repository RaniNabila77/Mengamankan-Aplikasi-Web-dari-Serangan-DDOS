<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Keanggotaan</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Umrah Game Developer</span>
        <div class="menu">
                <ul>
                    <li><a href="index.html">Home</a></li>
                </ul>
        </div>
    </nav>
    
    <div class="container">
        <div class="register my-4">
            <img src="image/GameDeveloper1.png" alt="car" style="width: 500px;" class="img-fluid" />
            <h2>Formulir Pendaftaran Keanggotaan</h2>

            <?php
            include "koneksi.php"; // Pastikan file ini ada dan berisi koneksi ke database

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Mengambil data dari formulir secara aman
                $nama = mysqli_real_escape_string($kon, htmlspecialchars($_POST["nama"]));
                $email = mysqli_real_escape_string($kon, htmlspecialchars($_POST["email"]));
                $alamat = mysqli_real_escape_string($kon, htmlspecialchars($_POST["alamat"]));
                $no_telpon = mysqli_real_escape_string($kon, htmlspecialchars($_POST["no_telpon"]));
                $angkatan = mysqli_real_escape_string($kon, htmlspecialchars($_POST["angkatan"]));
                $peran = mysqli_real_escape_string($kon, htmlspecialchars($_POST["peran"]));
                $pengalaman = mysqli_real_escape_string($kon, htmlspecialchars($_POST["pengalaman"]));

                // Menyiapkan pernyataan SQL
                $stmt = $kon->prepare("INSERT INTO registrasi (nama, email, alamat, no_telpon, angkatan, peran, pengalaman) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $nama, $email, $alamat, $no_telpon, $angkatan, $peran, $pengalaman);

                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Pendaftaran berhasil.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Pendaftaran gagal: " . $stmt->error . "</div>";
                }

                $stmt->close();
            }

            // Cek apakah ada permintaan untuk menghapus peserta
            if (isset($_GET['id_anggota'])) {
                $id_anggota = htmlspecialchars($_GET["id_anggota"]);
                $sql = "DELETE FROM registrasi WHERE id_anggota='$id_anggota'";
                $hasil = mysqli_query($kon, $sql);
                if ($hasil) {
                    echo "<div class='alert alert-success'>Data berhasil dihapus.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Data gagal dihapus.</div>";
                }
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="no_telpon">No Telp:</label>
                    <input type="tel" id="no_telpon" name="no_telpon" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="angkatan">Angkatan:</label>
                    <input type="text" id="angkatan" name="angkatan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="peran">Peran:</label>
                    <input type="text" id="peran" name="peran" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="pengalaman">Pengalaman:</label>
                    <textarea id="pengalaman" name="pengalaman" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Daftar</button>
                <p><a href="index.html" class="btn btn-link">Back</a></p>
            </form>
        </div>
    </div>
</body>
</html>
