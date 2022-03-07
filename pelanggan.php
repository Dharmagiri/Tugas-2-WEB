<?php

require 'ceklogin.php';

//jumlah pelanggan
$h1 = mysqli_query($c,"select * from pelanggan");
$h2 = mysqli_num_rows($h1); // jumlah pelanggan

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>DATA PELANGGAN</title>
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
                        <h1 class="mt-4">Data Pelanggan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">88 PHONE CELL</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-3">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Pelanggan: <?=$h2;?></div>
                                </div>
                            </div> 
                        </div>

                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-info mb-4" data-toggle="modal" data-target="#myModal">
                            Tambah Pelanggan
                        </button>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Pelanggan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelanggan</th>
                                            <th>No Telphone</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $get = mysqli_query($c,"select * from pelanggan");
                                    $i = 1; //penomoran

                                    while($p=mysqli_fetch_array($get)){
                                    $namapelanggan = $p['namapelanggan'];
                                    $notelphone = $p['notelphone'];
                                    $alamat = $p['alamat'];
                                    $idpl = $p['idpelanggan'];

                                    ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$namapelanggan;?></td>
                                            <td><?=$notelphone;?></td>
                                            <td><?=$alamat;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning mb-4" data-toggle="modal" data-target="#edit<?=$idpl;?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idpl;?>">
                                                    Delete
                                                </button>
                                        <tr>

                                            <!-- modal edit -->
                                            <div class="modal" id="edit<?=$idpl;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Ubah <?=$namapelanggan;?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form method="post">

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <input type="text" name="namapelanggan" class="form-control" placeholder="Nama pelanggan" value="<?=$namapelanggan;?>">
                                                    <input type="text" name="notelphone" class="form-control mt-2" placeholder="notelphone" value="<?=$notelphone;?>">
                                                    <input type="text" name="alamat" class="form-control mt-2" placeholder="alamat" value="<?=$alamat;?>">
                                                    <input type="hidden" name="idpl" value="<?=$idpl;?>">
                                                </div>

                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="editpelanggan">Submit</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                                
                                                </form>

                                            </div>
                                            </div>


                                            <!-- modal delete -->
                                        <div class="modal" id="delete<?=$idpl;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Hapus <?=$namapelanggan;?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form method="post">

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Apakah Anda Yakin Menghapus Data Pelanggan?
                                                    <input type="hidden" name="idpl" value="<?=$idpl;?>">
                                                </div>

                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="hapuspelanggan">Submit</button>
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
          <h4 class="modal-title">TAMBAH DATA PELANGGAN</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post">

        <!-- Modal body -->
        <div class="modal-body">
            <input type="text" name="namapelanggan" class="form-control" placeholder="Nama Pelanggan">
            <input type="text" name="notelphone" class="form-control mt-2" placeholder="No Telphone">
            <input type="text" name="alamat" class="form-control mt-2" placeholder="Alamat">
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="tambahpelanggan">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
        </form>

      </div>
    </div>
  </div>

</html>