<?php
    //membuat koneksi
    $conn=mysqli_connect("localhost","root","","phpdatabase");
    //Cek koneksi
    if(!$conn)
    {
        die('Koneksi Error : '.mysqli_connect_errno()
        .' - '.mysqli_connect_error());
    }
    //ambil data dari tabel mahasiswa/query data mahasiswa
    $result=mysqli_query($conn,"SELECT * FROM mahasiswa1 ");
    
    //function query
    function query($query_kedua)
    {
        global $conn;
        $result = mysqli_query($conn,$query_kedua);
        $rows =[];
        while ($row = mysqli_fetch_assoc($result))
        {
            $rows[]=$row;
        }
        return $rows;
    }

    function tambah($data)
    {
        global $conn;

        $nama=htmlspecialchars($data["nama"]);
        $nim=htmlspecialchars($data["nim"]);
        $email=htmlspecialchars($data["email"]);
        $jurusan=htmlspecialchars($data["jurusan"]);
        //$gambar=htmlspecialchars($data["gambar"]);

        $gambar=upload();
        if(!$gambar)
        {
            return false;
        }

        $query= "INSERT INTO mahasiswa1 VALUES
                ('','$nama','$nim','$email','$jurusan','$gambar')";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
    }

    function Hapus($id)
    {
        global $conn;
        mysqli_query($conn,"DELETE FROM mahasiswa1 WHERE id=$id ");
        return mysqli_affected_rows($conn);
    }

    function edit($data)
    {
        global $conn;

        $id=$data["id"];
        $nama=htmlspecialchars($data["nama"]);
        $nim=htmlspecialchars($data["nim"]);
        $email=htmlspecialchars($data["email"]);
        $jurusan=htmlspecialchars($data["jurusan"]);
        $GambarLama=htmlspecialchars($data["GambarLama"]);

        //cek apakah user menekan tombol browse
        if($_FILES['Gambar'] [error] === 4)
        {
            $gambar = $GambarLama;
        }
        else
        {
            $gambar = upload();
        }

        $query = " UPDATE mahasiswa1 SET
                    nama = '$nama',
                    nim = '$nim',
                    email = '$email', 
                    jurusan = '$jurusan', 
                    gambar = '$gambar' 
                    where id = $id ";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);

        //generate id untuk penamaan gambar dengan function uniquid()
        $namafilebaru = uniqid();
        $namafilebaru .= '.';
        $namafilebaru .= $pecah_gambar;
        // var_dump ($namafilebaru); die();

        move_uploaded_file($tmpfile, 'image/'. $namafilebaru);

        // kita return nama filenya agar tidak masuk ke $gambar=$upload() pada function tambah
        return $namafilebaru;

    }

    function cari($keyword)
    {
        $sql="SELECT * FROM mahasiswa1
              WHERE 
              nama like '%$keyword%' OR
              nim like '%$keyword%' OR
              email like '%$keyword%' OR
              jurusan like '%$keyword%' 
              ";
        return query($sql);
    }

    function upload()
    {
        $nama_file = $_FILES['gambar']['name'];
        $ukuran_file = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpfile = $_FILES['gambar']['tmp_name'];

        if($error===4)
        {
            //pastikan pada inputan gambar tidak terdapat attribute required
            echo "
                <script>
                    alert('Tidak ada gambar yang di upload');
                </script>
                ";
            return false;
        }

        $jenis_gambar=['jpg', 'jpeg', 'gif'];
        $pecah_gambar=explode('.', $nama_file);
        $pecah_gambar=strtolower(end($pecah_gambar));
        if(!in_array($pecah_gambar,$jenis_gambar))
        {
            echo "
            <script>
                alert('yang Anda upload bukan file gambar');
            </script>
            ";
            return false;
        }

        // cek kapasitas gambar dalam byte. jika 1000000 byte = 1 Megabyte
        if($ukuran_file > 10000000)
        {
            echo "
                <script>
                    alert('ukuran gambar terlalu besar');
                </script>
            ";
            return false;
        }

        move_uploaded_file($tmpfile, 'image/'. $nama_file);

        // kita return nama filenya agar dapat masuk ke $gambar=$upload() pada function tambah
        return $nama_file;
    }

    function registrasi ($data)
    {
        global $conn;

        $username = strtolower(stripcslashes($data['username']));

        $password = mysqli_real_escape_string($conn,$data['password']);
        $password2 = mysqli_real_escape_string($conn,$data['password2']);

        $result = mysqli_query($conn,"SELECT username FROM user WHERE username='$username'");

        if(mysqli_fetch_assoc($result))
        {
            echo "
                <script>
                    alert('username sudah ada');
                </script>
                ";
                return false;
        }
        if($password!=$password2)
        {
            echo "
            <script>
                alert('password anda tidak sama');
            </script>
            ";
            return false;
        }
        
        //enkripsi password
        $password=md5($password);

        //$password=password_hash($password,PASSWORD_DEFAULT);
        var_dump($password);

        mysqli_query ($conn,"INSERT INTO user VALUES ('','$username','$password')");

        return mysqli_affected_rows($conn);
    }
?>