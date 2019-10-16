<?php  
session_start();

if( !isset($_SESSION['login']) ){
	header("Location: login.php");
	exit;
}
require "core/functions.php";

//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])){


	// cek apaakah data berhasil di tambahkan atau tidak
	if( tambah($_POST) > 0 ) {
		echo "

				<script>
					alert('data berhasil ditambahkan!');
					document.location.href = 'index.php';
				</script>

				";
	}else{
		echo "

				<script>
					alert('data gagal ditambahkan!');
					document.location.href = 'index.php';
				</script>

				";
	}
}
	$title = 'tambah data';
	require "views/header.php";
?>



<div class="container">
	<div class="card">
  <div class="card-header">
    <h1>Tambah Data Mahasiswa</h1>
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
		    <label for="nis">NIS :</label>
		    <input type="text" class="form-control" id="nis" name="nis">
		</div>
		<div class="form-group">
		    <label for="nama">Nama :</label>
		    <input type="text" class="form-control" id="nama" name="nama">
		</div>

		<div class="form-group">
		    <label for="jeniskelamin">Jenis Kelamin</label>
		    <select class="form-control" id="jeniskelamin" name="jeniskelamin">
		      <option value="laki-laki">Laki - Laki</option>
		      <option value="perempuan">Perempuan</option>
		    </select>
		</div>

		<div class="form-group">
		    <label for="telp">telp</label>
		    <input type="text" class="form-control" id="telp" name="telp">
		</div>
		
		<div class="form-group">
		    <label for="alamat">alamat</label>
		    <input type="text" class="form-control" id="alamat" name="alamat">
		</div>
		<div class="form-group">
		    <label for="Foto">Foto</label>
		     <div class="custom-file">
			    <input type="file" class="custom-file-input" id="foto" aria-describedby="inputGroupFileAddon01" name="foto">
			    <label class="custom-file-label" for="foto">Choose file</label>
			  </div>
		</div>
		<button class="btn btn-primary" type="submit" id="submit" name="submit">SUBMIT</button>
		<a href="index.php" class="btn btn-warning">KEMBALI</a>

	</form>	

  </div>
</div>

</div>



	
	
	

<?php require "views/header.php"; ?>