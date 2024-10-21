<?php
	include 'db.php';

	// Check if the user ID is set in the URL
	if (isset($_GET['idp'])) {
		$delete = mysqli_query($conn, "DELETE FROM tb_pelanggan WHERE pelanggan_id = '".$_GET['idp']."'");
   		echo '<script>window.location="index.php"</script>';
	} else {}
?>
