<?php 

session_start();
require 'core/functions.php';

// set cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
	$id  = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
	$result = mysqli_query($conn,"SELECT username FROM user WHERE id=$id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if( $key === hash('sha256', $row['username']) ){
		$_SESSION['login'] = true;
	}
}

if( !isset($_SESSION['login']) ){
	header("Location: login.php");
	exit;
}

// pagination
// konfigurasi
$jumlahDataPerHalaman =5;
$jumlahData = count(query("SELECT * FROM siswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["hal"]) ) ? $_GET['hal'] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;
$no = $awalData+1;
$siswa = query("SELECT * FROM siswa  ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");	

?>

<!-- header -->
<?php 
$title = 'CRUD';
require 'views/header.php'; 
?>

<!-- body -->
<div class="container">
	
	<a href="logout.php" class="btn btn-dark m-3 float-right">LOGOUT</a>
	

	<div class="row">
       	<h3 class="m-3">CRUD Prosedural</h3>
	</div>
	
	<form action="" method="post">
		
		<div class="input-group col-md-6">
  			<input type="text" class="form-control" placeholder="Masukan Keyword Pencarian.."  name="keyword" autocomplete="off" id="keyword">
			<div class="input-group-append">
		    	<button class="btn btn-outline-secondary" type="submit" id="cari" name="cari">cari</button>
			</div>
		</div>
	</form>

	<div class="row col-md-12">
		<a href="tambah.php" class="btn btn-primary m-3 " >TAMBAH DATA</a>	
	</div>
	<div id="ajaxCari">
	

	<!-- table data -->
	<table class="table table-bordered">
	  <thead>
	    <tr class="text-center">
	      <th scope="col">NO.</th>
	      <th scope="col">FOTO</th>
	      <th scope="col">NIS</th>
	      <th scope="col">NAMA</th>
	      <th scope="col">JENIS KELAMIN</th>
	      <th scope="col">NO.TELEPON</th>
	      <th scope="col">ALAMAT</th>
	      <th scope="col">AKSI</th>
	    </tr>
	  </thead>
	  <tbody>

	  	<?php foreach( $siswa as $row ) : ?>
	    <tr>
	      <th scope="row" class="text-center"><?= $no++; ?></th>
	      <td class="text-center"><img src="assets/img/<?= $row['foto'];?>" style="width: 50px;"></td>
	      <td><?= $row['nis']; ?></td>
	      <td><?= $row['nama']; ?></td>
	      <td><?= $row['jenis_kelamin']; ?></td>
	      <td><?= $row['telp']; ?></td>
	      <td><?= $row['alamat']; ?></td>
	      <td>
				<a href="edit.php?id=<?= $row["id"];?>" class="badge badge-warning">edit</a>
				<a href="hapus.php?id=<?= $row["id"];?>" class="badge badge-danger" onclick="return confirm('apakah anda yakin akan menghapus ?')">hapus</a>
	      </td>    
	    </tr>

		<?php endforeach; ?>

	  </tbody>
	</table>
	
	<!-- pagination  -->
	<nav aria-label="...">
	  <ul class="pagination justify-content-center">
		<?php if( $halamanAktif > 1) : ?>  	
		     <li class="page-item">
		      <a class="page-link" href="?hal=<?= $halamanAktif - 1; ?>" aria-label="Previous">
		        <span aria-hidden="true">&laquo;</span>
		      </a>
		    </li>
	    <?php else: ?>
			<li class="page-item disabled">
		      <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><span aria-hidden="true">&laquo;</span></a>
		    </li>
	    <?php endif; ?>

	  	<?php for($i=1; $i<= $jumlahHalaman; $i++): ?>
		<?php if( $i == $halamanAktif ) : ?>
		    <li class="page-item active" aria-current="page">
		      <span class="page-link">
		        <?= $i; ?>
		        <span class="sr-only">(current)</span>
		      </span>
		    </li>
	    <?php else : ?>
		    <li class="page-item"><a href="?hal=<?= $i; ?>" class="page-link"><?= $i; ?></a></li>
	    <?php endif; ?>
		<?php endfor; ?>

	   <?php if( $halamanAktif < $jumlahHalaman) : ?>  	
		     <li class="page-item">
		      <a class="page-link" href="?hal=<?= $halamanAktif + 1; ?>" aria-label="Previous">
		        <span aria-hidden="true">&raquo;</span>
		      </a>
		    </li>
	    <?php else: ?>
			<li class="page-item disabled">
		      <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><span aria-hidden="true">&raquo;</span></a>
		    </li>
	    <?php endif; ?>

	  </ul>
	</nav>


	</div>
</div>

<?php require "views/footer.php"; ?>