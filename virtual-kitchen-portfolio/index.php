    <?php
    require 'recipes.php';

    // Gets the term typed into the search form and stores it as 'searchTerm'
    $searchTerm = isset($_GET['search']) ? ($_GET['search']) : '';  

    // Searches for the recipe that matches searchTerm
    if ($searchTerm) {
        $recipes = searchRecipes($searchTerm);  
    // Show all recipes if no search term is entered
    } else {
        $recipes = getAllRecipes();  
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Recipes</title>

        <!-- Favicon is the logo of Virtual Kitchen -->
        <link rel="icon" type="image/x-icon" href="favicon.ico.png" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="CSS/style.css" />
    </head>

    <body>
        <header id="main-header">
            <section id="title">
                <!-- Virtual Kitchen logo -->
                <img src="myLogo.png" alt="Logo" style="width:100px; height:80px;">
                <h1>Virtual Kitchen</h1>
            </section>

            <!-- Navigation in the header -->
            <nav>
                <a href="login.php">Home Page</a>
                <a href="index.php">Recipes</a>
                <a href="add_recipe.php">Add Recipes</a>
                <a href="update_recipe.php">Update Recipes</a>
                <a href="logout.php">Log out</a>
            </nav>
            
        </header>

        <main>
            <!-- action submits the form to the same page -->
        <form method="GET" action="" id="search-form">
                <input type="text" name="search" placeholder="Search recipes..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit">Search</button>
            </form>
            
            <?php
        //start the session, check if the user is not logged in, redirect to start
        session_start();	

        // If theres no username redirect to login.php
        if (!isset($_SESSION['username'])){
            header("Location: login.php");
            exit();
        }

        //Otherwise continue to index.php and output Welcome (username)
        $username=$_SESSION['username'];
        echo "<h3> Welcome ".$_SESSION['username']."! </h3>";
        
        // include the connectdb.php to connect to the database
        require_once ('connectdb.php');  	
    ?>
            <!-- Displaying the Recipes based on search term or all recipes -->
            <div id="recipe-list">
                <?php
                if (!empty($recipes)) {
                    // foreach is an array to loop through
                    foreach ($recipes as $recipe) {
                        echo "<div class='recipe'>";
                        echo "<h2><a href='recipe.php?rid=" . $recipe['rid'] . "'>" . htmlspecialchars($recipe['name']) . "</a></h2>";
                        echo "<p>" . htmlspecialchars($recipe['description']) . "</p>";
                        echo "<p><strong>Type:</strong> " . htmlspecialchars($recipe['type']) . "</p>";
                        echo '<img src="' . htmlspecialchars($recipe['image']) . '" alt="Recipe Image">';
                        echo "</div>";
                    }
                } else {
                    echo "<p>No recipes found. Please try a different search term.</p>";
                }
                ?>
            </div>
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
