<?php 
 
include 'config.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    // $password = hash(sha256,PASSWORD_BCRYPT, $_POST['password']);
    $password = ($_POST['password']);
    if(!empty($email) || !empty($password)){
    $seq=mysqli_query($conn,"select * from users where email='$email' ");
    $data=mysqli_fetch_array($seq);
    $jml=mysqli_num_rows($seq);
    if($jml>0){
        if(password_verify($password, $data['password'])) {
            $_SESSION['username']=$data['username'];
            $_SESSION['user_autentification']="valid";
            if ($data['level']=="Admin") {
                $_SESSION['level'] = "Admin";
                header("location:index.php");
            }
            elseif ($data['level']=="Peminjam") {
                $_SESSION['level'] = "Peminjam";
                header("location:index.php");
            }
            
        }else{
            echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
        }
    }else{
        echo "<script>alert('Email salah!'); window.location.href='login.php';</script>";
    }   
}
 
    // $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    // $result = mysqli_query($conn, $sql);
    // if ($result->num_rows > 0) {
    //     $row = mysqli_fetch_assoc($result);
    //     $_SESSION['username'] = $row['username'];
    //     header("Location: index.php");
    // } else {
    //     echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    // }
}
 
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" type="text/css" href="style.css">
 
    <title>Niagahoster Tutorial</title>
</head>
<body>
    <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['error']?>
    </div>
 
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            
        </form>
    </div>
</body>
</html>