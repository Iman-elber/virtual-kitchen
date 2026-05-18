<?php

// If the form has been submitted
if (isset($_POST['submitted'])) {

    // Connect to the database
    require_once('connectdb.php');

    $username = ($_POST['username'] ?? '');
    $password = ($_POST['password'] ?? '');
    $email = ($_POST['email'] ?? '');
    $error = '';

    if (empty($username)) {
        $error = "Username cannot be empty!";
    } elseif (empty($password)) {
        $error = "Password cannot be empty!";
     } elseif (empty($email)) {
            $error = "Email cannot be empty!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format!";
    } else {
        try {
            // Check for existing username
            $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            if ($stmt->fetchColumn()) {
                $error = "That username or email is already taken.";
            } else {
                // Insert new user
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
                $stmt->execute([$username, $hashedPassword, $email]);

                // Success message if you've registered
                $success = "You are now registered, go back to <a href='login.php'>login</a>.";
              
            }
        } catch (PDOException $ex) {
            $error = "Database error: " . $ex->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/style.css" />
</head>
<body>
<header id="main-header">
  <section id="title">
    <img src="myLogo.png" alt="Logo" style="width:100px; height:80px;">
    <h1>Virtual Kitchen</h1>
  </section>

  <nav>
    
    <a href="login.php">Login</a>
    
</nav>
</header>

<main id="registration" class="container my-5">
    <h2>Register</h2>

     <!-- Error message alert -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

     <!-- Success message alert -->
    <?php if (!empty($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>


    <form method="post" action="register.php">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input class="form-control" type="text" name="username" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" required>
        </div>
        <div class="mb-3">
    <label class="form-label">Email</label>
    <input class="form-control" type="email" name="email" required>
</div>
        <input type="hidden" name="submitted" value="true" />
        <button type="submit" class="btn btn-primary">Register</button>
        <button type="reset" class="btn btn-secondary">Clear</button>
    </form>

    <p>Already a user? <a href="login.php">Log in</a></p>
</main>

<footer>
    <section id="restaurantDetails">
        <section id="footerIntro">
            <img src="myLogo.png" alt="Logo" style="width:100px; height:80px">
            <h3>Where you can find us</h3>
        </section>
        <ul style="list-style-type:none;">
            <li>Name: Iman Abbas El ber</li>
            <li>Student ID Number: 240090339</li>
            <li>www.virtualkitchen.com</li>
            <li>Based in Birmingham, England</li>
            <li><a href="mailto:240090339@aston.ac.uk">240090339@aston.ac.uk</a></li>
        </ul>
    </section>
</footer>
</body>
</html>

