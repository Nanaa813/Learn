<?php
	include 'db.php';

	// Check if the user ID is set in the URL
	if (isset($_GET['idr'])) {
		$produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '".$_GET['idr']."'");
		$p = mysqli_fetch_object($produk);

		unlink('./images/'.$p->product_image);

		$delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '".$_GET['idr']."'");
   		echo '<script>window.location="dataproduk-admin.php"</script>';
	}
?>
