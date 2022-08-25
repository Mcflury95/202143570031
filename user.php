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
        Daftar Users
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8"></div>
          <div class="col-md-4">
            <div class="mb-3">
            <input type="text" class="form-control" id="search" name="search" placeholder="Cari disini...">
          </div>
          </div>
        </div>
          <div id="hasil"></div>
        <p class="text-center mt-2"><a href="" target="_blank" style="text-decoration:none;"></a></p>
      </div>
    </div>
      
              
    </div>
    <div><br></div>
    
</div>
</section>
<div><br><br></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    load_data();
    function load_data(search){
      $.ajax({
        url:"get_data.php",
        method:"POST",
        data: {
          search: search
        },
        success:function(data){
          $('#hasil').html(data);
        }
      });
    }
    $('#search').keyup(function(){
      var search = $("#search").val();
      load_data(search);
    });
  });
  </script>
</body>
</html>

