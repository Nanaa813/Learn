<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Beauty</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
</head>
<body id="bg-login" style="	background-image: url(images/IMG-20230207-WA0211.png); background-repeat: no-repeat; background-position: center; display: fixed; background-size: cover;">
	<div class="box-login">
		<h2>Login</h2>
		<form action="" method="POST">
			<input type="text" name="user" placeholder="Username" class="input-control">
			<input type="password" name="pass" placeholder="Password" class="input-control">
			<button type="submit" name="submit" value="Login"> submit </button>
		</form>
        <button class="button-space" onclick="window.location='index.php'">Kembali ke Beranda</button>

		<?php 
			if (isset($_POST['submit'])) {
			    session_start();
			    include 'db.php';

			    $user = mysqli_real_escape_string($conn, $_POST['user']);
			    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

			    // Check in tb_admin
			    $cek_admin = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$user."' AND password = '".MD5($pass)."'");
			    if (mysqli_num_rows($cek_admin) > 0) {
			        $d = mysqli_fetch_object($cek_admin);
			        $_SESSION['status_login'] = true;
			        $_SESSION['a_global'] = $d;
			        $_SESSION['id'] = $d->admin_id;
			        echo '<script>window.location="dashboard-admin.php"</script>';
			    } else {
			        // If not found in admin, check in tb_pelanggan
			        $cek_pelanggan = mysqli_query($conn, "SELECT * FROM tb_pelanggan WHERE username = '".$user."' AND password = '".MD5($pass)."'");
			        if (mysqli_num_rows($cek_pelanggan) > 0) {
			            $d = mysqli_fetch_object($cek_pelanggan);
			            $_SESSION['status_login'] = true;
			            $_SESSION['a_global'] = $d;
			            $_SESSION['id'] = $d->pelanggan_id;
			            echo '<script>window.location="dashboard-pelanggan.php"</script>';
			        } else {
			            // If no records found in both tables
			            echo '<script>alert("Username atau password Anda salah!")</script>';
			        }
			    }
			}
		?>
	</div>
</body>
</html>