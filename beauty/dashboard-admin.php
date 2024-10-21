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
	<title>Beauty Store Kendari | Beranda</title>
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
			<h3>Dashboard</h3>
			<div class="box">
				<h4>Selamat Datang <?php echo $_SESSION['a_global']->admin_name ?>, di Toko Online Kami</h4>
				<h5><a href="dataproduk-admin.php">List Produk</a></h5>

				<!-- Form Pencarian -->
            	<div class="search-box">
                	<form method="POST" action="">
                    	<input type="text" name="search_query" placeholder="Cari produk..." required>
                    	<button type="submit">Cari</button>
                 	</form>
             	</div>

			<!-- Hasil Pencarian -->
            <?php
			// Ambil produk dari database
			include 'db.php';
			$product = [];
			$sql = "SELECT * FROM tb_product"; // Ganti 'tb_product' dengan nama tabel Anda
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
    			while ($row = $result->fetch_assoc()) {
        			$product[] = $row; // Menyimpan seluruh informasi produk ke dalam array
    			}
			}

			$hasil_cari = [];

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
    			$search_query = htmlspecialchars($_POST['search_query']);
    			foreach ($product as $item) {
        			if (stripos($item['product_name'], $search_query) !== false) {
            			$hasil_cari[] = $item; // Menyimpan seluruh informasi produk yang ditemukan
        			}
    			}
			}

			// Menangani hasil pencarian
			if (!empty($hasil_cari)) {
    			echo "<h4>Hasil Pencarian:</h4>";
    			echo '<table border="0" cellspacing="0" class="table">';
    			echo '<thead>
            			<tr>
            				<th>No</th>
            				<th>Nama Produk</th>
            				<th>Harga</th>
            				<th>Deskripsi</th>
            				<th>Gambar</th>
            				<th>Status</th>
            				<th>Aksi</th>
            			</tr>
           			  </thead>
           			  <tbody>';

    			$no = 1;

    			foreach ($hasil_cari as $item) {
        			echo "<tr>
                			<td>{$no}</td>
                			<td>{$item['product_name']}</td>
                			<td>Rp. " . ($item['product_price']) . "</td>
                			<td>{$item['product_description']}</td>
                			<td><img src='images/{$item['product_image']}' style='width: 100px; height: 100px;'></td>
                			<td>" . (($item['product_status'] == 0) ? 'Tidak Ada' : 'Ada') . "</td>
                			<td>
                  				<a href='editproduk.php?id={$item['product_id']}'>Edit</a> || 
                  				<a href='hapusproduk.php?idk={$item['product_id']}' onclick=\"return confirm('Yakin?')\">Hapus</a>
                			</td>
              		  	   </tr>";
        
               		$no++;
    			}

    			echo '</tbody></table>';
			} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    			echo "<h4>Tidak ada hasil untuk '$search_query'</h4>";
			}
			?>

			
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