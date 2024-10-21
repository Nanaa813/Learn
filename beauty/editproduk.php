<?php 
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

	$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."'");
	if (mysqli_num_rows($produk) == 0) {
		echo '<script>window.location="dataproduk-admin.php"</script>';
	}
	$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Beauty Store Kendari | Edit</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
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
			<h3>Edit Data Produk</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="text" name="nama" placeholder="Nama Produk" class="input-control" value="<?php echo $p-> product_name ?>" required>
					<input type="text" name="harga" placeholder="Harga" class="input-control" value="<?php echo $p-> product_price ?>" required>
					<textarea name="deskripsi" placeholder="Deskripsi" class="input-control"><?php echo $p->product_description ?></textarea><br>
					
					<img src="images/<?php echo $p->product_image ?>" width = "300px">
					<input type="hidden" name="foto" value="<?php echo $p->product_image?>">
					<input type="file" name="gambar" class="input-control">
					<select class="input-control" name="status">
						<option value="">--Pilih--</option>
						<option value="1" <?php echo ($p->product_status == 1)? 'selected':''; ?>>Ada</option>
						<option value="0" <?php echo ($p->product_status == 0)? 'selected':''; ?>>Tidak Ada</option>
					</select>
					<input type="submit" name="submit" value="Update" class="btn">
				</form>
				<?php  
					if (isset($_POST['submit'])) {
						
						// data inputan dr form
						$nama 		= $_POST['nama'];
						$harga 		= $_POST['harga'];
						$deskripsi 	= $_POST['deskripsi'];
						$status 	= $_POST['status'];
						$foto 		= $_POST['foto'];

						// data gambar baru
						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

						// if admin ganti gambar
						if ($filename != '') {

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
								unlink('./images/'.$foto);
								move_uploaded_file($tmp_name, './images/'.$newname);
								$namagambar = $newname;
							}

						} else {

							// if admin tidak ganti gambar bcs males
							$namagambar = $foto;

						}

						// query update data produk
						$update = mysqli_query($conn, "UPDATE tb_product SET
												product_name = '".$nama."', 
												product_price = '".$harga."',
												product_description = '".$deskripsi."',
												product_image = '".$namagambar."',
												product_status = '".$status."'
												WHERE product_id = '".$p->product_id."' ");
						if($update){
							echo '<script>alert("Edit data berhasil")</script>';
							echo '<script>window.location="dataproduk-admin.php"</script>';
						}else{
							echo 'gagal '.mysqli_error($conn);
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
</body>
</html>