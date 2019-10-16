<?php 

require 'connect.php';

function query($query){

	global $conn;

	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result) ){
		$rows[] = $row;
	}

	return $rows;
}

function tambah($data){
	global $conn;

	$nis = htmlspecialchars($data["nis"]); 
	$nama = htmlspecialchars($data["nama"]); 
	$jenis_kelamin = htmlspecialchars($data["jeniskelamin"]); 
	$telp = htmlspecialchars($data["telp"]); 
	$alamat = htmlspecialchars($data["alamat"]); 
	

	//upload foto
	$foto = upload();
	if (!$foto){
		return false;
	}
	
	$query =  "INSERT INTO siswa
				VALUES
				('','$nis','$nama','$jenis_kelamin','$telp','$alamat','$foto') 
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload(){

	$namaFile = $_FILES['foto']['name'];
	$ukuranFile = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmpName = $_FILES['foto']['tmp_name'];

	//cek apakah tidak ada foto 
	if ($error === 4){
		echo "<script>
				alert('pilih foto terlebih dahulu!');
			 </script>";
			 return false;
	}

	//cek apakah yang di upload adalah foto
	$ekstensiFotoValid = ['jpg','jpeg','png'];
	$ekstensiFoto = explode('.',$namaFile);
	$ekstensiFoto = strtolower(end($ekstensiFoto));
	if( !in_array($ekstensiFoto, $ekstensiFotoValid)){
		echo "<script>
				alert('yang anda upload bukan foto!');
			 </script>";
			 return false;
	} 

	// cek jika ukurannya terlalu besar
	if( $ukuranFile > 1000000){
		echo "<script>
				alert('Ukuran foto Terlalu Besar!');
			 </script>";
			 return false;
	}

	//lolos pengecekan, foto siap diupload
	//generate nama foto baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFoto;
	move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru);

	return $namaFileBaru;

}

function hapus($id){
	global $conn;

	$data = mysqli_query($conn,"SELECT * FROM siswa WHERE id= $id");
	$row = mysqli_fetch_array($data);
	$foto = $row['foto'];
	unlink("assets/img/" . $foto);
	$query = mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function ubah($data){
	global $conn;

	$id = $data["id"];
	$nis = htmlspecialchars($data["nis"]);
	$nama = htmlspecialchars($data["nama"]);
	$jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
	$telp = htmlspecialchars($data["telp"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$fotoLama = htmlspecialchars($data["fotoLama"]);


	if( $_FILES['foto']['error'] === 4 ){
		$foto = $fotoLama;
	}else{
		unlink("assets/img/" . $fotoLama);
		$foto = upload(); 
	}


	$query =  "UPDATE siswa SET
				nis = '$nis',
				nama = '$nama',
				jenis_kelamin = '$jeniskelamin',
				telp = '$telp',
				alamat = '$alamat',
				foto = '$foto'
				
			   WHERE id = $id";

	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);

}



function registrasi($data) {
	global $conn;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username sudah ada atau belom
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if( mysqli_fetch_assoc($result) ){
		echo "<script>
				alert('username sudah terdaftar');
			 </script>";

		return false;
	}

	// cek konfirmasi password
	if ( $password !== $password2 ) {
		echo "<script>
				alert('Konfirmasi password tidak sesuai');
				 </script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	
	// tambah userbaru ke database
	mysqli_query($conn, "INSERT INTO user VALUES ('','$username','$password')");

	return mysqli_affected_rows($conn);
}