<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Beauty</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
</head>
<body id="bg-login" style=" background-image: url(images/IMG-20230207-WA0211.png); background-repeat: no-repeat; background-position: center; display: fixed; background-size: cover;">
    <div class="box-login">
        <h2>Register</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="user" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Create Account</button>
        </form>
         <button class="button-space" onclick="window.location='index.php'">Kembali ke Beranda</button>
        
        <?php 
            session_start(); // Start the session at the top
            include 'db.php'; // Include your database connection file

            // Initialize message variable
            $message = "";

            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Collect and sanitize input data
                $username = htmlspecialchars(trim($_POST['user']));
                $email = htmlspecialchars(trim($_POST['email']));
                $password = htmlspecialchars(trim($_POST['password']));

                // Hash the password using MD5 for demonstration purposes
                $hashed_password = md5($password); // Use of MD5

                // Prepare and bind the SQL statement
                $stmt = $conn->prepare("INSERT INTO tb_pelanggan (username, pelanggan_email, password) VALUES (?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param("sss", $username, $email, $hashed_password);

                    // Execute the statement
                    if ($stmt->execute()) {
                        echo '<script>
                                alert("Account created successfully for ' . $username . '!");
                                window.location = "index.php";
                            </script>';

                    } else {
                        // Handle errors (e.g., duplicate entry)
                        if ($conn->errno === 1062) {
                            $message = "Username or email already exists.";
                        } else {
                            $message = "Error: " . $stmt->error;
                        }
                    }

                    // Close statement
                    $stmt->close();
                } else {
                    $message = "Error preparing statement: " . $conn->error;
                }
            }
        ?>

        <!-- Display message -->
        <p><?php echo $message; ?></p>
    </div>
</body>
</html>
