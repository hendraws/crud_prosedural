<?php

session_start();

if( !isset($_SESSION['login']) ){
	header("Location: login.php");
	exit;
}
require "core/functions.php";

$id = $_GET['id'];
$siswa = query("SELECT * FROM siswa WHERE id=$id")[0]; 


//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])){


	// cek apaakah data berhasil di ubah atau tidak
	if( ubah($_POST) > 0 ) {
		echo "

				<script>
					alert('data berhasil diubah!');
					document.location.href = 'index.php';
				</script>

				";
	}else{
		// echo "

		// 		<script>
		// 			alert('data gagal diubah!');
		// 			document.location.href = 'index.php';
		// 		</script>

		// 		";
	}


}



$title = 'Halaman Edit';
require 'views/header.php';

?>


<div class="container">
	<div class="card">
  <div class="card-header">
    <h1 class="text-center">Edit Data Mahasiswa</h1>
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="id" value="<?= $siswa['id']; ?>">
    	<input type="hidden" name="fotoLama" value="<?= $siswa['foto']; ?>">
		<div class="form-group">
		    <label for="nis">NIS :</label>
		    <input type="text" class="form-control" id="nis" name="nis" value="<?= $siswa['nis']; ?>">
		</div>
		<div class="form-group">
		    <label for="nama">Nama :</label>
		    <input type="text" class="form-control" id="nama" name="nama" value="<?= $siswa['nama']; ?>">
		</div>

		<div class="form-group">
		    <label for="jeniskelamin">Jenis Kelamin</label>
		    <select class="form-control" id="jeniskelamin" name="jeniskelamin"  ?>">
		      <option <?php if( $siswa['jenis_kelamin'] == "laki-laki"){echo "selected "; } ?>value="laki-laki">Laki - Laki</option>
		      <option <?php if( $siswa['jenis_kelamin'] == "perempuan"){echo "selected "; } ?>value="perempuan">Perempuan</option>
		    </select>
		</div>

		<div class="form-group">
		    <label for="telp">telpon</label>
		    <input type="text" class="form-control" id="telp" name="telp" value="<?= $siswa['telp']; ?>">
		</div>
		
		<div class="form-group">
		    <label for="alamat">alamat</label>
		    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $siswa['alamat']; ?>">
		</div>
		<div class="form-group">
		    <label for="Foto">Foto</label>
	     	<div class="row"><img src="assets/img/<?= $siswa['foto']; ?>" alt=""></div>
		    <div class="custom-file">
			    <input type="file" class="custom-file-input" id="foto" name="foto">
			    <label class="custom-file-label" for="foto">Choose file</label>
			 </div>
		</div>
		<button class="btn btn-primary" type="submit" id="submit" name="submit">SUBMIT</button>
		<a href="index.php" class="btn btn-warning">KEMBALI</a>

	</form>	

  </div>
</div>

</div>






<?php require 'views/footer.php'; ?>