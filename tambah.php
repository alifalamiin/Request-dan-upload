<?php
    //buat koneksi
    $conn=mysqli_connect("localhost","root","","phpdatabase");

    //cek apakah button submit sudah ditekan atau belum
    if(isset($_POST['submit']))
    {
        //ambil data dri tiap elemen dalam form yang disimpan di variable baru
        $nama=$_POST["nama"];
        $nim=$_POST["nim"];
        $email=$_POST["email"];
        $jurusan=$_POST["jurusan"];
        $gambar=$_POST["gambar"];

        //query inserrt data
        $query="INSERT INTO mahasiswa1 
                VALUES
                ('','$nama','$nim','$email','$jurusan','$gambar')";
        mysqli_query($conn,$query);

        //cek sukses data ditambah menggunakan mysqli_affected_rows
        //jika kita var_dump maka akan muncul int(1) jika gagal maka akan muncul int(-1)
        //var_dump(mysqli_affected_rows($conn));

        if(mysqli_affected_rows($conn)>0)
        {
            echo "data berhasil disimpan";
        }
        else
        {
            echo "gagal!";
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
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data mahasiswa1</h1>
    <form action="" method="post">
    <ul>
        <li>
            <!-- for pada label terhubung dengan id jadi jika tabel nama diklik maka text field nama akan aktif juga -->
            <label for="nama">Nama</label>
            <!-- untuk pengisian nama besar kecilnya harus sesuai dengan fieldnya -->
            <input type="text" name="nama" id="nama">
        </li>
        <li>
            <label for="nim">Nim</label>
            <input type="text" name="nim" id="nim">
        </li>
        <li>
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
        </li>
        <li>
            <label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan">
        </li>
        <li>
            <label for="gambar">Gambar</label>
            <input type="text" name="gambar" id="gambar">
        </li>
        <li>
            <button type="submit" name="submit">Tambah</button>
        </li>
    </ul>
    </form>
</body>
</html>