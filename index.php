<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
include_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php include 'navbar.php';?>
<?php include 'carousel.php';?>

<div class="container">
    
  
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">Tambah Data</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Modal Header</h4>

        </div>
        
            
       
        <div class="modal-body">
          <p>Tambah Data Baru</p>
          <?php 
          $result = mysqli_query($conn, "SELECT * FROM games ORDER BY id_game DESC");
          $jumlah_data = mysqli_num_rows($result);
          $jmlh=$jumlah_data+1;
          $nounik="DVD".$jmlh;
           ?>
          <form action="function.php?act=tambahdata" method="post" name="form">
              <div class="row mb-3">
                <label for="inputEmail3" hidden class="col-sm-3 col-form-label">No</label>
                <div class="col-sm-8">
                  <input type="text" name="id_game" readonly hidden value="<?php echo $nounik ?>" class="form-control" id="inputEmail3">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Judul Game</label>
                <div class="col-sm-8">
                  <input type="text" name="judul_game" class="form-control" id="inputEmail3">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Kategori</label>
                <div class="col-sm-8">
                  <input type="text" name="id_kategori" class="form-control" id="inputPassword3">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Cover Game</label>
                <div class="col-sm-8">
                  <textarea class="form-control" name="cover_game" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Harga</label>
                <div class="col-sm-8">
                  <input type="text" name="harga" class="form-control" id="inputPassword3">
                </div>
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <input type="submit" class="btn btn-primary" name="Submit" value="Tambah">
              </div>
            </form>
        </div>
      </div>
    </div>
  </div><br><br>
  


  <div class="row">
    <?php  
    $batas = 8;
    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;    
    $previous = $halaman - 1;
    $next = $halaman + 1;
    $result = mysqli_query($conn, "SELECT * FROM games ORDER BY id_game DESC");
    $jumlah_data = mysqli_num_rows($result);
    $total_halaman = ceil($jumlah_data / $batas);
    $data = mysqli_query($conn,"select * from games ORDER BY id_game DESC limit $halaman_awal, $batas");
    $nomor = $halaman_awal+1;
    $jmlh=$jumlah_data+1;
    $nounik="DVD".$jmlh;
    while($game_data = mysqli_fetch_array($data)) {
    ?>
    <div class="col-md-3 col-sm-6 col-12">
            <div class="card" >
                <img class="card-img-top" src="<?php echo $game_data['cover_game'] ?>"  alt="Card image">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $game_data['judul_game'] ?></h4>
                    <p class="card-text"><?php echo number_format($game_data['harga'], 0, ",", ".")?></p>
                    <?php if ($_SESSION['level'] == 'Admin'){
                      ?>
                      <span class="badge badge-pill badge-danger"><?php echo $game_data['status'];?></span>
                      <a class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#updatedata<?php echo $game_data['id_game'];?>">Edit</a>
                    <?php }elseif ($_SESSION['level'] == 'Peminjam') { 
                      ?>
                      <span class="badge badge-pill badge-success"><?php echo $game_data['status'];?></span>
                    <?php } ?>
                </div>
            </div><br>
          </div>
          <div class="example-modal">
                        <div id="updatedata<?php echo $game_data['id_game'];?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                              <h3 class="modal-title">Edit Data</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                
                              </div>
                              <div class="modal-body">
                              <form action="function.php?act=updatedata" method="post" name="form">
                                  <div class="row mb-3">
                                  <label for="inputEmail3" class="col-sm-3 col-form-label">Id</label>
                                      <div class="col-sm-8">
                                      <input type="text" name="id_game" class="form-control" value="<?php echo $game_data['id_game'] ?>"  readonly="readonly">
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                  <label for="inputEmail3" class="col-sm-3 col-form-label">Judul Game</label>
                                      <div class="col-sm-8">
                                      <input type="text" name="judul_game" class="form-control" value="<?php echo $game_data['judul_game'] ?>">
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                  <label for="inputPassword3" class="col-sm-3 col-form-label">Kategori</label>
                                      <div class="col-sm-8">
                                      <input type="text" name="id_kategori" class="form-control" value="<?php echo $game_data['id_kategori'] ?>" >
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                  <label for="inputPassword3" class="col-sm-3 col-form-label">Cover Game</label>
                                      <div class="col-sm-8">
                                      <textarea class="form-control" name="cover_game" rows="3"><?php echo $game_data['cover_game'] ?></textarea>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                  <label for="inputPassword3" class="col-sm-3 col-form-label">Harga</label>
                                      <div class="col-sm-8">
                                      <input type="text" name="harga" class="form-control" value="<?php echo $game_data['harga'] ?>" >
                                      </div>
                                  </div>

                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                  <input type="submit" class="btn btn-primary" name="Submit" value="Update">
                                  </div>
                              </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
    <?php } ?>
  </div>
  <nav>
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
        </li>
        <?php 
        for($x=1;$x<=$total_halaman;$x++){
            ?> 
            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
            <?php
        }
        ?>              
        <li class="page-item">
            <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
        </li>
    </ul>
</nav>
</div>
</body>
</html>

