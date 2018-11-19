<?php
require 'function.php';
// cek apakah button submit sudah di tekan atau belum
// menggunakan mehtod get untuk mengambil id yg telah
// terseleksi oleh user dan dimasukkan ke dalam variabel 
// baru yaitu $id
$id=$_GET["id"];
// var_dump($id);

// query berdasar id
$mhs=query("SELECT * FROM mahasiswa1 WHERE id=$id")[0];
//var_dump($mhs);
//var_dump($mhs[0]["Nama"]);

if(isset($_POST['submit']))
{
    // cek sukses data dirubah menggunakan dunction edit pada function.php
    if(edit($_POST)>0)
    {
        echo "
        <script>
        alert('data berhasil diperbarui');
        document.location.href='Index1.php';
        </script>
        ";
    }
    else
    {
        echo "
        <script>
        alert('data gagal diperbaruhi');
        document.location.href='Edit.php';
        </script>";
        echo "<br>";
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="D:\Teknik Informatika\Semester 3\Desain & Pemrograman Web\Minggu 7\BAB 5 BOOTSTRAP\bootstrap-3.3.7-dist\css\bootstrap-theme.css">
    <script type="text/javascript" src="D:\Teknik Informatika\Semester 3\Desain & Pemrograman Web\Minggu 7\BAB 5 BOOTSTRAP\bootstrap-3.3.7-dist\js\bootstrap.js"></script>
    <title>Update Data</title>
</head>
<body>
    <h1> Update Data Mahasiswa</h1>
    <form action="" method="post">
    <ul>
        <li>
            <!--for pada tabel terhubung dengan id 
            jika label nama diklik maka textfield
            nama akan aktif juga -->
            <label for="Nama">Nama :</label>
            <!-- untuk pengisian name besar kecil harus sesuai
            dengan fieldnya -->
            <input type="text" name="Nama" id="Nama">
        </li>
        <li>
            <label for="NIM">NIM :</label>
            <input type="text" name="Nim" id="Nim" required>
        </li>
        <li>
            <label for="Email">Email :</label>
            <input type="text" name="Email" id="Email" required>
        </li>
        <li>
            <label for="Jurusan">Jurusan :</label>
            <input type="text" name="Jurusan" id="Jurusan" required>
        </li>
        <li>
            <label for="Gambar">Gambar :</label>
            <input type="text" name="Gambar" id="Gambar" required>
        </li>
        <li>
            <button type="submit" name="submit">Update</button>
        </li>
    </ul>
    </form>
</body>
</html>