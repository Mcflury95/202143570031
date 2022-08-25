<?php
include_once("config.php");
 
    // Check If form submitted, insert form data into users table.
    if($_GET['act'] == 'tambahdata'){
    	$id_game = $_POST['id_game'];
        $id_kategori = $_POST['id_kategori'];
        $judul_game = $_POST['judul_game'];
        $cover_game = $_POST['cover_game'];
        $harga = $_POST['harga'];
        
                
        // Insert user data into table
        $result = mysqli_query($conn, "INSERT INTO games(id_game,id_kategori,judul_game,cover_game,harga) VALUES('$id_game','$id_kategori','$judul_game','$cover_game','$harga')");
        if ($result) {
        # code redicet setelah insert ke index
        header("location:index.php");
	    }
	    else{
	        echo "ERROR, tidak berhasil". mysqli_error($conn);
	    }
        }
    elseif($_GET['act']=='updatedata'){
    	$id_game = $_POST['id_game'];
	    $id_kategori = $_POST['id_kategori'];
        $judul_game = $_POST['judul_game'];
        $cover_game = $_POST['cover_game'];
        $harga = $_POST['harga'];

	    //query update
	    $queryupdate = mysqli_query($conn, "UPDATE games SET id_kategori='$id_kategori' , judul_game='$judul_game' , cover_game='$cover_game', harga='$harga' WHERE id_game='$id_game'");
	    if ($queryupdate) {
	        # credirect ke page index
	        header("location:index.php");    
	    }
	    else{
	        echo "ERROR, data gagal diupdate". mysqli_error($conn);
	    }
	}
	elseif($_GET['act']=='kembali'){
    	$id_game = $_POST['id_game'];
	    $satus = "Ready";
        

	    //query update
	    $queryupdate = mysqli_query($conn, "UPDATE games SET status='Ready' WHERE id_game='$id_game'");
	    if ($queryupdate) {
	        # credirect ke page index
	        header("location:pinjam.php");    
	    }
	    else{
	        echo "ERROR, data gagal diupdate". mysqli_error($conn);
	    }
	}
	elseif($_GET['act']=='pinjam'){
    	$id_game = $_POST['id_game'];
	    $satus = "Pinjam";
        

	    //query update
	    $queryupdate = mysqli_query($conn, "UPDATE games SET status='Pinjam' WHERE id_game='$id_game'");
	    if ($queryupdate) {
	        # credirect ke page index
	        header("location:pinjam.php");    
	    }
	    else{
	        echo "ERROR, data gagal diupdate". mysqli_error($conn);
	    }
	}

    
    ?>