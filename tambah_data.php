<?php
    require 'function.php';
    //cek apakah button submit sudah diklik atau belum
    if(isset($_POST['submit']))
    {

        // cek isi dari post menggunakan vardump
        var_dump($_POST);
        var_dump($_FILES);
        die();

        //cek suukses data ditambah menggunakan function pada function.php
        if(tambah($_POST>0))
        {
            echo "
        <script>
            alert('data berhasil disimpan');
            document.location.href='Index1.php';
        </script>";
        }
    else
    {
        echo "
        <script>
            alert('data gagal disimpan');
            document.location.href='tambah_data.php';
        </script>";
        echo "<br>";
        echo mysqli_error($conn);
    }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data mahasiswa1</h1>
    <form action="" method="post" enctype="multipart/form-data"> 
    <ul>
        <li>
            <!-- for pada label terhubung dengan id jadi jika tabel nama diklik maka text field nama akan aktif juga -->
            <label for="nama">Nama</label>
            <!-- untuk pengisian nama besar kecilnya harus sesuai dengan fieldnya -->
            <input type="text" name="nama" id="nama" required>
        </li>
        <li>
            <label for="nim">Nim</label>
            <input type="text" name="nim" id="nim" required>
        </li>
        <li>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
        </li>
        <li>
            <label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" required>
        </li>
        <li>
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar" required>
        </li>
        <li>
            <button type="submit" name="submit">Tambah</button>
        </li>
    </ul>
    </form>
</body>
</html>