<?php 

require '../core/functions.php';
$keyword = $_GET["keyword"];

// pagination
// konfigurasi
$query = "SELECT * FROM siswa
			 	WHERE 
			 	nis LIKE '%$keyword%' OR
			 	nama LIKE '%$keyword%' OR
			 	jenis_kelamin LIKE '%$keyword%' OR
			 	alamat LIKE '%$keyword%' OR
			 	telp LIKE '%$keyword%'
			 ";	
$siswa = query($query);
$no = 1;

?>


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
