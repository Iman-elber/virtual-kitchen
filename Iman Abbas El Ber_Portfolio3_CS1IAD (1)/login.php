<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Login</title>

    <!--Favicon is the logo of Virtual Kitchen.-->
    <link rel="icon" type="image/x-icon" href="favicon.ico.png" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="CSS/style.css" />
</head>

<body>
<header id="main-header">
  <section id="title">
    <img src="myLogo.png" alt="Logo" style="width:100px; height:80px;">
    <h1>Virtual Kitchen</h1>
  </section>

  <nav>
            <a href="login.php">Home Page</a>
            <a href="register.php">Register</a>
        </nav>

</header>

  <main>

        <!-- Images of some dishes-->
        <section id="images">
            <img src="Ful.jpg" alt="Ful Medamas" style="width:33%; height:235px;">
            <!-- Image reference: https://www.themediterraneandish.com/foul-mudammas-recipe/ -->
            <img src="Legemat.jpg" alt="Legemat/Zalabiya" style="width:33%; height:235px;">
            <!--Image reference: https://edition.cnn.com/travel/gallery/top-desserts-photos/index.html -->
            <img src="Tamiya.jpg" alt="Tamiya/Falafel" style="width:33%; height:235px;">
            <!--Image reference: https://flamingstove.com/product/falafels/ -->
        </section>
        <br>

        <div id="error-message">
        <?php
        session_start();

        // If the form is submitted and username and password aren't present then output error message.
        if (isset($_POST['submitted'])) {
            if (!isset($_POST['username'], $_POST['password'])) {
                exit('Please fill both the username and password fields!');
            }

            require_once("connectdb.php");

            try {
                $stat = $db->prepare('SELECT uid, password FROM users WHERE username = ?');
                $stat->execute([$_POST['username']]);

                // Checks if username and password match
                if ($stat->rowCount() > 0) {
                    $row = $stat->fetch();

                    if (password_verify($_POST['password'], $row['password'])) {
                        $_SESSION["username"] = $_POST['username'];
                        $_SESSION["uid"] = $row['uid'];
                        header("Location:index.php");
                        exit();
                    } else {
                        echo "<p style='color:red'>Error logging in, password does not match </p>";
                    }
                } else {
                    echo "<p style='color:red'>Error logging in, Username not found </p>";
                }
            } catch (PDOException $ex) {
                echo("Failed to connect to the database.<br>");
                echo($ex->getMessage());
                exit;
            }
        }
        ?>
      </div>

        <form id="login-form" action="login.php" method="post">
  <label for="username">Username</label>
  <input type="text" id="username" name="username" maxlength="25" />

  <label for="password">Password</label>
  <input type="password" id="password" name="password" maxlength="25" />

  <input type="submit" value="Login" />
  <input type="reset" value="Clear" />
  <input type="hidden" name="submitted" value="TRUE" />
</form>

    
  
</header>

<section id="description">
            <!-- Short history of the virtual kitchen’s website -->
            <h1> Who Are We? </h1>
            <p> At Virtual Kitchen we work hard to deliver our users with top quality recipe
                listings with a range of cuisines while also offering opportunities to add their own. This digital space allows food lovers
                to immerse themselves in the flavourful world of different cuisines. </p>
            <p> Virtual Kitchen, established in 2018, values its customers and aims to use
                modern technology alongside tradition.</p>

            <!-- Signature dishes. -->
            <h4> Our signature dishes include: </h4>
            <ul style="list-style-type:none;">
                <li>Tamiya/Falafel</li>
                <li>Legemat/Zalabiya</li>
            </ul>
        </section>

        <!-- User reviews-->
        <h1> Here's What Our Users Have To Say:</h1>
        <section id="testimonials">

            <blockquote>
                <p><em>"I love how Virtual Kitchen provides <strong>step-by-step</strong> cooking instructions"</em></p>
                <p>Iman</p>
            </blockquote>

            <blockquote>
                <p><em>"I appreciate how <strong>simple</strong> it is to add and update recipes"</em></p>
                <p>Abbas</p>
            </blockquote>

        </section>


    </main>
    <footer>

        <!-- Footer with:
         website address and email and my name, email and student id number  -->
        <section id="restaurantDetails">
            <section id="footerIntro">
                <img src="myLogo.png" alt="Logo" style="width:100px; height:80px">
                <h3>Where you can find us</h3>

            </section>

            <ul style="list-style-type:none;">
                <li>Name: Iman Abbas El ber</li>
                <li>Student ID Number: 240090339</li>
                <li> www.virtualkitchen.com</li>
                <li>Based in Birmingham, England</li>
                <li> <a href="mailto:240090339@aston.ac.uk">240090339@aston.ac.uk</a></li>

            </ul>

        </section>

    </footer>
</body>

</html>