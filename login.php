<?php 
session_start();
if( isset($_SESSION["login"]) ){
	header("Location: index.php");
			exit;
}


require "core/functions.php";

if( isset($_POST["login"]) ){

	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$result   = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'" );

	// cek username
	if( mysqli_num_rows($result) === 1 ) {


		// cek password
		$row = mysqli_fetch_assoc($result);
		if ( password_verify($password, $row["password"]) ){
			// set session
			$_SESSION["login"] = true;

			// cek remember me
			if( isset($_POST['remember']) ){ 
				// buat cookie
				setcookie('id', $row['id'], time()+60);
				setcookie('key', hash('sha256', $row['username']), time()+60 );

				 

			}
				header("Location: index.php");
			exit;
			
			
		}else{
			echo "<script>
					alert('password salah!');
				  </script>";

		}
	}else{
		echo "<script>
				alert('username salah / tidak ditemukan !');
			 </script>";

	}

}



$title = 'Halaman Login';
require "views/header.php"; 
?>


<div class="container mt-5">
<div class="col-md-6 offset-md-3">
<div class="card">
  <div class="card-header text-center">
    <h3>LOGIN USER</h3>
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
		 <div class="form-group form-check">
		    <input type="checkbox" class="form-check-input" id="remember" name="remember">
		    <label class="form-check-label" for="remember">Remember Me</label>
		  </div>
		<button class="btn btn-primary" type="submit" id="login" name="login">LOGIN</button>
		<a href="index.php" class="btn btn-warning">KEMBALI</a>	

	</form>	

  </div>
</div>
</div>

</div>







<?php require "views/footer.php"; ?>