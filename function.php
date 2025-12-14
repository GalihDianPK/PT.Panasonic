<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "stockbarang"); //connect database

// cek connect database
// if ($conn) {
//     echo "berhasil";
// }

//? menambanh barang baru
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

//? menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstokbarang = mysqli_query($conn, "SELECT * FROM stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstokbarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;


    //? gapakai tanggal karena sdah otomatis settingan di mysql nya dan id masuk sudah ada di masuk php

    $addtomasuk = mysqli_query($conn, "INSERT into masuk (idbarang, keterangan, qty) values('$barangnya', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock= '$tambahkanstocksekarangdenganquantity' where idbarang= '$barangnya'");

    //? cek apakah dua query berhasil & masuk ke ddatabase 
    if($addtomasuk&&$updatestockmasuk) { 
        header('Location:masuk.php');
    } else { 
        echo "Gagal";
        header('Location:masuk.php');
    }
} 

//? menambah barang keluar
if(isset($_POST['addnewbarang'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstockbarang = mysqli_query($conn, "SELECT * FROM stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstockbarang);

    $stocksekarang = $ambildatanya['stock'];    
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;


    //? gapakai tanggal karena sdah otomatis settingan di mysql nya dan id masuk sudah ada di masuk php
    
    $addtokeluar = mysqli_query($conn, "INSERT into keluar (idbarang, penerima, qty) values('$barangnya', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock= '$tambahkanstocksekarangdenganquantity' where idbarang= '$barangnya'");

    //? cek apakah dua query berhasil & masuk ke ddatabase  

    if($stocksekarang < $qty){    
        echo "saldo tidak cukup";
        header('Location:keluar.php');
    }

    if($addtokeluar && $updatestockmasuk) { 
        header('Location:keluar.php');
    } else { 
        echo "Gagal";
        header('Location:keluar.php');
    }
} 
?>