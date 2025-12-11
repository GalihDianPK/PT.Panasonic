<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "stockbarang"); //connect database

// cek connect database
// if ($conn) {
//     echo "berhasil";
// }

// menambanh barang baru
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn, "insert into stock (namabarang, deskripsi, stock) values('$namabarang', '$deskripsi', '$stock')");
    if($addtotable) {
        header('Location: index.php');
    } else {
        echo "Gagal";
        header('Location: index.php');
    }
}

?>