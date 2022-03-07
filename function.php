<?php

session_start();

//Bikin koneksi
$c = mysqli_connect('localhost','root','','kasir');
if ($c) {
    echo "Berhasil";
}
//Login
if(isset($_POST['login'])){
    //Insert Variable
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($c,"SELECT * FROM user WHERE username='$username' and password='$password'");
    $hitung = mysqli_num_rows($check);

    if($hitung>0){
        //Jika datanya ditemukan
        //berhasil login

        $_SESSION['login'] = 'True';
        header('location:index.php');
    } else {
        //Data tidak ditemukan
        //gagal login
        echo '
        <script>alert("Username atau Password salah");
        window.location.href="login.php"
        </script>
        ';
    }

}

if(isset($_POST['tambahbarang'])){
    $namaproduk = $_POST['namaproduk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];

    $insert = mysqli_query($c,"insert into produk (namaproduk,deskripsi,harga,stock) values ('$namaproduk','$deskripsi','$harga','$stock')");

    if($insert){
        header('location:stock.php');
    } else {
        echo '
        <script>alert("Gagal menambah barang baru");
        window.location.href="stock.php"
        </script>
        ';
    }
}

if(isset($_POST['tambahpelanggan'])){
    $namapelanggan = $_POST['namapelanggan'];
    $notelphone = $_POST['notelphone'];
    $alamat = $_POST['alamat'];

    $insert = mysqli_query($c,"insert into pelanggan (namapelanggan,notelphone,alamat) values ('$namapelanggan','$notelphone','$alamat')");

    if($insert){
        header('location:pelanggan.php');
    } else {
        echo '
        <script>alert("Gagal menambah pelanggan baru");
        window.location.href="pelanggan.php"
        </script>
        ';
    }
}

if(isset($_POST['tambahpesanan'])){
    $idpelanggan = $_POST['idpelanggan'];

    $insert = mysqli_query($c,"insert into pesanan (idpelanggan) values ('$idpelanggan')");

    if($insert){
        header('location:index.php');
    } else {
        echo '
        <script>alert("Gagal menambah pesanan baru");
        window.location.href="index.php"
        </script>
        ';
    }
}

//produk dipilih pada pesanan
if(isset($_POST['addproduk'])){
    $idpr = $_POST['idproduk'];
    $idp = $_POST['idp']; //idpesanan
    $qty = $_POST['qty']; //jumlah yang mau dikeluarkan

    //hitung stock sekarang ada berapa
    $hitung1 = mysqli_query($c,"select * from produk where idproduk='$idpr'");
    $hitung2 = mysqli_fetch_array($hitung1);
    $stocksekarang = $hitung2['stock']; //stock barang saat ini

    if($stocksekarang>=$qty){

        //kurangi stocknya dengan jumlah yang akan dikeluarkan
        $selisih = $stocksekarang-$qty;

        //stocknya cukup
        $insert = mysqli_query($c,"insert into detailpesanan (idpesanan,idproduk,qty) values ('$idp','$idpr','$qty')");
        $update = mysqli_query($c,"update produk set stock='$selisih' where idproduk='$idproduk'");

        if($insert&&$update){
            header('location:view.php?idp='.$idp);
        } else {
            echo '
        <script>alert("Gagal menambah pesanan baru");
        window.location.href="view.php?idp='.$php.'"
        </script>
        ';
        }
    } else {
        //stock tidak cukup
        echo '
        <script>alert("Stock Barang Tidak Cukup");
        window.location.href="view.php?idp='.$idp.'"
        </script>
        ';
    }
}

//menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $idproduk = $_POST['idproduk'];
    $qty = $_POST['qty'];

    $insertb = mysqli_query($c,"insert into masuk (idproduk,qty) values('$idproduk','$qty')");

    if($insertbarangmasuk){
        header('location:masuk.php');
    } else {
        echo '
        <script>alert("Maaf Coba Lagi");
        window.location.href="masuk.php"
        </script>
        ';
    }
}

//hapus produk pesanan
if(isset($_POST['hapusprodukpesanan'])){
    $idp = $_POST['idp'];
    $idpr = $_POST['idpr'];
    $idpesanan = $_POST['idpesanan'];

    //cek qty 
    $cek1 = mysqli_query($c,"select *  from detailpesanan where iddetailpesanan='$idp'");
    $cek2 = mysqli_fetch_array($cek1);
    $qtysekarang = $cek2['qty'];

    //cek stock saat ini
    $cek3 = mysqli_query($c,"select * from produk where idproduk='$idpr'");
    $cek4 = mysqli_fetch_array($cek3);
    $stocksekarang = $cek4['stock'];

    $hitung = $stocksekarang+$qtysekarang;

    $update = mysqli_query($c,"update produk set stock='$hitung' where idproduk='$idpr'"); //update stock
    $hapus = mysqli_query($c,"delete from detailpesanan where idproduk='$idpr' and iddetailpesanan='$idp'");

    if($update&&$hapus){
        header('location:view.php?idp='.$idpesanan);

    } else {}
 
}


//edit barang
if(isset($_POST['editbarang'])){
    $np = $_POST['namaproduk'];
    $desc = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $idp = $_POST['idp']; //idproduk

    $query = mysqli_query($c,"update produk set namaproduk='$np', deskripsi='$desc', harga='$harga' where idproduk='$idp' ");

    if($query){
        header('location:stock.php');
    } else {
        echo'
        <script>alert("Gagal");
        window.location.href="stock.php"
        </script>
        ';
    }

}

//hapusbarang
if(isset($_POST['hapusbarang'])){
    $idp = $_POST['idp'];

    $query = mysqli_query($c,"delete from produk where idproduk='$idp'");
    if($query){
        header('location:view.php?idp='.$idpesanan);
} else {
    echo'
        <script>alert("Gagal");
        window.location.href="stock.php"
        </script>
        ';
    }
}

//edit pelanggan
if(isset($_POST['editpelanggan'])){
    $np = $_POST['namapelanggan'];
    $nt = $_POST['notelphone'];
    $a = $_POST['alamat'];
    $idpl = $_POST['idpl'];

    $query = mysqli_query($c,"update pelanggan set namapelanggan='$np', notelphone='$nt', alamat='$a' where idpelanggan='$idp' ");

    if($query){
        header('location:pelanggan.php');
    } else {
        echo'
        <script>alert("Gagal");
        window.location.href="pelanggan.php"
        </script>
        ';
    }

}

//hapuspelanggan

if(isset($_POST['hapuspelanggan'])){
    $idpl = $_POST['idpl'];

    $query = mysqli_query($c,"delete from pelanggan where idpelanggan='$idpl'");
    if($query){
        header('location:view.php?idp='.$idpesanan);
} else {
    echo'
        <script>alert("Gagal");
        window.location.href="pelanggan.php"
        </script>
        ';
    }
}

?>