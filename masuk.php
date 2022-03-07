<?php

require 'ceklogin.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>STOCK BARANG</title>
        
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Pencatatan Kasir</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">MENU</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="far fa-comments"></i></div>
                                PEMESANAN
                            </a>
                            <a class="nav-link" href="stock.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-shapes"></i></div>
                                STOK PEMESANAN
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-cart-arrow-down"></i></div>
                                BARANG MASUK
                            </a>
                            <a class="nav-link" href="pelanggan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-kiss-wink-heart"></i></div>
                                KELOLA PELANGGAN
                            </a>
                            <a class="nav-link" href="logout.php">
                                LOGOUT
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Barang Masuk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">88 PHONE CELL</li>
                        </ol>

                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-info mb-4" data-toggle="modal" data-target="#myModal">
                            Tambah Barang Masuk
                        </button>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Barang Masuk
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $get = mysqli_query($c,"select * from masuk m,produk p where m.idproduk=p.idproduk");
                                    $i = 1;

                                    while($p=mysqli_fetch_array($get)){
                                    $namaproduk = $p['namaproduk'];
                                    $deskripsi = $p['deskripsi'];
                                    $idmasuk = $p['idmasuk'];
                                    $qty = $p['qty'];
                                    $tanggal = $p['tanggalmasuk'];

                                    ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$namaproduk;?></td>:  <td><?=$deskripsi;?></td>
                                            <td><?=$qty;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning mb-4" data-toggle="modal" data-target="#edit<?=$idmasuk;?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idmasuk;?>">
                                                    Delete
                                                </button>
                                        <tr>

                                            <!-- modal edit -->
                                            <div class="modal" id="edit<?=$idmasuk;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Ubah <?=$namaproduk;?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form method="post">

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <input type="text" name="namaproduk" class="form-control" placeholder="Nama produk" value="<?=$namaproduk;?>:  <?=$deskripsi;?>">
                                                    <input type="number" name="harga" class="form-control mt-2" placeholder="Harga produk" value="<?=$qty;?>">
                                                    <input type="hidden" name="idp" value="<?=$idproduk;?>">
                                                </div>

                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="editbarang">Submit</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                                
                                                </form>

                                            </div>
                                            </div>


                                            <!-- modal delete -->
                                        <div class="modal" id="delete<?=$idproduk;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Hapus <?=$namaproduk;?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form method="post">

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Apakah Anda Yakin Menghapus Barang Ini?
                                                    <input type="hidden" name="idp" value="<?=$idproduk;?>">
                                                </div>

                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="hapus">Submit</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                                
                                                </form>

                                            </div>
                                            </div>

                                    <?php
                                    }; //end of while
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

        <!-- The Modal -->
    <div class="modal" id="myModal">
       <div class="modal-dialog">
         <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">TAMBAH PESANAN BARU</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post">

        <!-- Modal body -->
        <div class="modal-body">
            Pilih Barang
            <select name="idproduk" class="form-control">

             <?php
             $getproduk = mysqli_query($c,"select * from produk");

            while($pl=mysqli_fetch_array($getproduk)){
                $namaproduk = $pl['namaproduk'];
                $stock = $pl['stock'];
                $deskripsi = $pl['deskripsi'];
                $idproduk = $pl['idproduk'];
        ?>

        <option value="<?=$idproduk;?>"><?=$namaproduk;?> - <?=$deskripsi;?> (Stock: <?=$stock;?>)</option>

        <?php
        }
        ?>
            
        </select>

        <input type="number" name="qty" class="form-control mt-4" placeholder="Jumlah" min="1" required>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="barangmasuk">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
        </form>

      </div>
    </div>
  </div>

</html>