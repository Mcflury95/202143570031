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
<header>
		<?php include 'navbar.php';?>
</header>
<body>
<div><br></div>
<section>
  <div class="container">
    <div class="card" >
      <div class="card-header">
        Daftar Pinjam DVD 
      </div>
      <table class="table ">
        <thead>
          <tr>
            <th >ID</th>
            <th scope="col">Judul</th>
            <th >Cover</th>
            <th>status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php  
          $batas = 8;
          $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
          $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;    
          $previous = $halaman - 1;
          $next = $halaman + 1;
          $result = mysqli_query($conn, "SELECT * FROM games where status='Pinjam' ORDER BY id_game DESC");
          $jumlah_data = mysqli_num_rows($result);
          $total_halaman = ceil($jumlah_data / $batas);
          $data = mysqli_query($conn,"select * from games where status='Pinjam' ORDER BY id_game DESC limit $halaman_awal, $batas");
          $nomor = $halaman_awal+1;
          $jmlh=$jumlah_data+1;
          $nounik="DVD".$jmlh;
          while($game_data = mysqli_fetch_array($data)) {
          ?>
          <tr>
            <th scope="row"><?php echo $game_data['id_game'];?></th>
            <td><?php echo $game_data['judul_game'] ?></td>
            <td><img class="card-img-top" src="<?php echo $game_data['cover_game'] ?>"  alt="Card image" width="10" height="80"> 
            </td>
            <td><span class="badge badge-pill badge-danger"><?php echo $game_data['status'];?></span></td>
            <td><a class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#kembali<?php echo $game_data['id_game'];?>">Kembalikan</a>
            </td>
          </tr>
          <div class="example-modal">
                        <div id="kembali<?php echo $game_data['id_game'];?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                              
                              </div>
                              <div class="modal-body">
                              <form action="function.php?act=kembali" method="post" name="form">
                                  <div class="row mb-3">
                                      <div class="col-sm-8">
                                      <input type="text" name="id_game" class="form-control" value="<?php echo $game_data['id_game'] ?>"  readonly="readonly" hidden>
                                      </div>
                                  </div>
                                  <div class="row mb-8">
                                  <label for="inputEmail3" class="col-sm-8 col-form-label">Apakah <?php echo $game_data['judul_game'] ?> ini akan di kembalikan?</label>
                                      
                                  </div>

                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                  <input type="submit" class="btn btn-primary" name="Submit" value="Kembalikan">
                                  </div>
                              </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
          <?php }; ?>
        </tbody>
      </table>
      
              
    </div>
    <div><br></div>
    <nav>
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
        </li>
        <?php 
        for($x=1;$x<=$total_halaman;$x++){
            ?> 
            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
        <?php }?>              
        <li class="page-item">
            <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
        </li>
    </ul>
</nav>
</div>
</section>
<div><br><br></div>
<section>
	<div class="container">
		<div class="card" >
		  <div class="card-header">
		    Daftar DVD Ready
		  </div>
		  <table class="table ">
        <thead>
          <tr>
            <th >ID</th>
            <th scope="col">Judul</th>
            <th >Cover</th>
            <th>status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php  
          $batas = 8;
          $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
          $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;    
          $previous = $halaman - 1;
          $next = $halaman + 1;
          $result = mysqli_query($conn, "SELECT * FROM games where status='Ready' ORDER BY id_game DESC");
          $jumlah_data = mysqli_num_rows($result);
          $total_halaman = ceil($jumlah_data / $batas);
          $data = mysqli_query($conn,"select * from games where status='Ready' ORDER BY id_game DESC limit $halaman_awal, $batas");
          $nomor = $halaman_awal+1;
          $jmlh=$jumlah_data+1;
          $nounik="DVD".$jmlh;
          while($game_data = mysqli_fetch_array($data)) {
          ?>
          <tr>
            <th scope="row"><?php echo $game_data['id_game'];?></th>
            <td><?php echo $game_data['judul_game'] ?></td>
            <td><img class="card-img-top" src="<?php echo $game_data['cover_game'] ?>"  alt="Card image" width="10" height="80"> 
            </td>
            <td><span class="badge badge-pill badge-success"><?php echo $game_data['status'];?></span></td>
            <td><a class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#pinjam<?php echo $game_data['id_game'];?>">Pinjam</a>
            </td>
          </tr>
          <div class="example-modal">
                        <div id="pinjam<?php echo $game_data['id_game'];?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                              
                              </div>
                              <div class="modal-body">
                              <form action="function.php?act=pinjam" method="post" name="form">
                                  <div class="row mb-3">
                                      <div class="col-sm-8">
                                      <input type="text" name="id_game" class="form-control" value="<?php echo $game_data['id_game'] ?>"  readonly="readonly" hidden>
                                      </div>
                                  </div>
                                  <div class="row mb-8">
                                  <label for="inputEmail3" class="col-sm-12 col-form-label">Apakah anda akan meminjam<?php echo $game_data['judul_game'] ?> ?</label>
                                      
                                  </div>

                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                  <input type="submit" class="btn btn-primary" name="Submit" value="Pinjam">
                                  </div>
                              </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
          <?php }; ?>
        </tbody>
      </table>
		</div>
    <div><br></div>
    <nav>
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
        </li>
        <?php 
        for($x=1;$x<=$total_halaman;$x++){
            ?> 
            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
        <?php }?>              
        <li class="page-item">
            <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
        </li>
    </ul>
</nav>
</div>
</section>
</body>
</html>

