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
	<title>Beauty Store Kendari | Produk</title>
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
				<li><a href="logout.php">Logout</a></li>
			</ul> 
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Produk</h3>
			<div class="box">
				<p><a href="tambahproduk.php">Tambah Produk</a></p>
				<table border="0" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th height="60px">Nama Produk</th>
							<th height="60px">Harga</th>
							<th height="60px">Deskripsi</th>
							<th height="60px">Gambar</th>
							<th height="60px">Status</th>
							<th width="130px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$no = 1;
							$produk = mysqli_query($conn, "SELECT * FROM tb_product ORDER BY product_name ASC");
							if (mysqli_num_rows($produk) > 0) {
							while ($row = mysqli_fetch_array($produk)) {
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td height="100px" width="200px"><?php echo $row['product_name'] ?></td>
							<td height="100px" width="100px">Rp. <?php echo ($row['product_price']) ?></td>
							<td height="100px"><?php echo $row['product_description'] ?></td>
							<td height="100px"><a href="images/<?php echo $row['product_image'] ?>" target="_blank"><img src="images/<?php echo $row['product_image'] ?>"style = "width: 200px; height: 200px;" ></a></td>
							<td height="100px"><?php echo ($row['product_status'] == 0)? 'Tidak Ada':'Ada'; ?></td>
							<td>
								<a href="editproduk.php?id=<?php echo $row['product_id'] ?>">Edit</a> || <a href="hapusproduk.php?idr=<?php echo $row['product_id'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
							</td>
						</tr>
						<?php }} else{ ?>
							<tr>
								<td colspan="8">Tidak ada data</td>
							</tr>

						<?php } ?>
					</tbody>
				</table>
			</div>
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