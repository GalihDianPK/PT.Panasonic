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

    $addtotable = mysqli_query($conn, "INSERT into stock (namabarang, deskripsi, stock) values('$namabarang', '$deskripsi', '$stock')");
    if($addtotable) {
        header('Location: index.php');
    } else {
        echo "Gagal";
        header('Location: index.php');
    }
}

// menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstokbarang = mysqli_query($conn, "SELECT * FROM stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstokbarang);

    // gapakai tanggal karena sdah otomatis settingan di mysql nya dan id masuk sudah ada di masuk php
    $addtomasuk = mysqli_query($conn, "INSERT into masuk (idbarang, keterangan, qty) values('$barangnya', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_queryy($conn, "update stock where stock= ");

    if($addtomasuk) {
        header('Location:index.php');
    } else { 
        echo "Gagal";
        header('Location:index.php');
    }
} 
?>