<?php
require 'function.php';

//Menggunakan method get untuk mengambil id yang telah terseleksi oleh user dan dimasukkan
//kedalam variabel baru yaitu $id
$id=$_GET["id"];

if(hapus ($id)>0)
{
    echo "
    <script>
        alert ('data berhasil dihapus');
        document.location.href='Index1.php';
    </script>";
}
else
{
    echo "
    <script>
        alert ('data gagal dihapus');
        document.location.href='Index.php';
    </script>";    
    echo "<br>";
    echo mysqli_error($conn);
}
?>