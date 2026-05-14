<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recipe</title>

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

    <div id="recipe-info">
<?php
require 'recipes.php';  

if (isset($_GET['rid'])) {
    //intval() returns the integer value of a variable -w3schools
    $rid = intval($_GET['rid']);  
    // Get recipe details using function from recipes.php
    $recipe = getRecipeById($rid);  

    if ($recipe) {
        echo "<h1>" . htmlspecialchars($recipe['name']) . "</h1>";
        echo "<p><strong>Type:</strong> " . htmlspecialchars($recipe['type']) . "</p>";
        echo "<p><strong>Description:</strong> " . htmlspecialchars($recipe['description']) . "</p>";
        echo "<p><strong>Ingredients:</strong> " . htmlspecialchars($recipe['ingredients']) . "</p>";
        echo "<p><strong>Instructions:</strong> " . nl2br(htmlspecialchars($recipe['instructions'])) . "</p>";
        echo '<img src="' . htmlspecialchars($recipe['image']) . '" alt="Recipe Image" width="300">';
        
    } else {
        echo "<p>Recipe not found.</p>";
    }
} else {
    echo "<p>No recipe selected.</p>";
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
