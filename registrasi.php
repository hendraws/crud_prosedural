<?php 
session_start();

if( !isset($_SESSION["login"]) ){
		header("Location : login.php")
	}

require "core/functions.php";

if( isset($_POST["register"]) ){

	if( registrasi($_POST) > 0 ) {
		echo "<script>

				alert('user baru berhasil ditambahkan!');

			 </script>";
	}else {
		echo mysqli_error($conn);
	}
}



$title = 'Daftar User';
require "views/header.php"; 
?>


<div class="container mt-5">
	<div class="card">
  <div class="card-header">
    <h1>Daftar User</h1>
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
		
		<div class="form-group">
		    <label for="username">Username :</label>
		    <input type="text" class="form-control" id="username" name="username">
		</div>
		<div class="form-group">
		    <label for="password">Password :</label>
		    <input type="password" class="form-control" id="password" name="password">
		</div>
		<div class="form-group">
		    <label for="password2">Konfirmasi Password :</label>
		    <input type="password" class="form-control" id="password2" name="password2">
		</div>
		
		<button class="btn btn-primary" type="submit" id="register" name="register">DAFTAR</button>
		<a href="index.php" class="btn btn-warning">KEMBALI</a>	

	</form>	

  </div>
</div>

</div>







<?php require "views/footer.php"; ?>