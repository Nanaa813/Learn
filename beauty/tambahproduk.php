<?php 
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Beauty Store Kendari | Menambah Data Produk</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
	<script src="https://cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script>

</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="dashboard-admin.php">Beauty Store Kendari</a></h1>
			<ul>
				<li><a href="logout.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Tambah Data Produk</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<h5>Nama Produk</h5>
					<input type="text" name="nama" placeholder="Nama Produk" class="input-control" required>
					<h5>Harga Produk</h5>
					<input type="text" name="harga" placeholder="Harga" class="input-control" required>
					<h5>Deskripsi Produk</h5>
					<textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea>
					<h5>Gambar Produk</h5>
					<input type="file" name="gambar" class="input-control" required>
					<h5>Status Produk</h5>
					<select class="input-control" name="status">
						<option value="">--Pilih--</option>
						<option value="1">Ada</option>
						<option value="0">Tidak Ada</option>
					</select>
					<input type="submit" name="submit" value="Tambah" class="btn">
				</form>
				<?php  
					if (isset($_POST['submit'])) {
						
						// print_r($_FILES['gambar']);
						// menampung inputan dari form
						$nama 		= $_POST['nama'];
						$harga 		= $_POST['harga'];
						$deskripsi 	= $_POST['deskripsi'];
						$status 	= $_POST['status'];

						// menampung data file yang diupload
						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'produk'.time().'.'.$type2;

						// menampung data format file yang diizinkan
						$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'webp');

						// validasi format file
						if(!in_array($type2, $tipe_diizinkan)){
							// jika format file tidak ada di dalam tipe diizinkan
							echo '<script>alert("Format file tidak diizinkan")</script>';

						}else{
							// jika format file sesuai dengan yang ada di dalam array tipe diizinkan
							// proses upload file sekaligus insert ke database
							move_uploaded_file($tmp_name, './images/'.$newname);

							$insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
										null,
										'".$nama."',
										'".$harga."',
										'".$deskripsi."',
										'".$newname."',
										'".$status."',
										null
											) ");

							if($insert){
								echo '<script>alert("Tambah data berhasil")</script>';
								echo '<script>window.location="dataproduk-admin.php"</script>';
							}else{
								echo 'gagal '.mysqli_error($conn);
							}
						}						
					}
				?>
			</div>
			<h4><a href="dataproduk-admin.php">Kembali ke Data Produk</a></h4>
		</div>
	</div>

	
	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2024 - Beauty Store Kendari.</small>
		</div>
	</footer>
	<script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>