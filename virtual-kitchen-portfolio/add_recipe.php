<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Add Recipe</title>

    <!--Favicon is the logo of Virtual Kitchen.-->
    <link rel="icon" type="image/x-icon" href="favicon.ico.png" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="CSS/style.css" />
</head>

<body>
    <header id="main-header">
        <section id="title">
            <!-- Virtual Kitchen logo.-->
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
<main id="add_form">
<?php
session_start();

// Must be logged in so redirects to login page.
if (!isset($_SESSION['uid'])) {
    die("Access denied. You must be logged in to add a recipe. <a href='login.php'>Login</a>");
}

// Ensure that the user ID exists in the session
if (empty($_SESSION['uid'])) {
    die("Session error: UID is not set.");
}

// Connect to database
require 'connectdb.php';

// If returns the request method used to access the page (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $cookingtime = $_POST['cookingtime'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $image = $_POST['image'];
    $uid = $_SESSION['uid'];  

    // When the form is submitted the values are added to the MySQL database.
    $sql = "INSERT INTO recipes (name, description, type, cookingtime, ingredients, instructions, image, uid) 
            VALUES (:name, :description, :type, :cookingtime, :ingredients, :instructions, :image, :uid)";
    
    $stmt = $db->prepare($sql);
    
    // Bind the parameters to the query
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':cookingtime', $cookingtime);
    $stmt->bindParam(':ingredients', $ingredients);
    $stmt->bindParam(':instructions', $instructions);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);  
    
    // Execute the query
    if ($stmt->execute()) {
        echo "<p style='color:green;'><strong>Recipe added successfully!</strong></p>";
    } else {
        echo " Failed to add recipe.";
    }
}
?>

<h1>Add Recipe</h1>

<form method="POST" class="container mt-4">

  <div class="mb-3">
    <label for="name" class="form-label">Recipe Name:</label>
    <input type="text" name="name" id="name" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Description:</label>
    <textarea name="description" id="description" class="form-control" required></textarea>
  </div>

  <div class="mb-3">
    <label for="type" class="form-label">Type:</label>
    <select name="type" id="type" class="form-select" required>
      <option value="French">French</option>
      <option value="Italian">Italian</option>
      <option value="Chinese">Chinese</option>
      <option value="Indian">Indian</option>
      <option value="Mexican">Mexican</option>
      <option value="Others">Others</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="cookingtime" class="form-label">Cooking Time (minutes):</label>
    <input type="number" name="cookingtime" id="cookingtime" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="ingredients" class="form-label">Ingredients:</label>
    <textarea name="ingredients" id="ingredients" class="form-control" required></textarea>
  </div>

  <div class="mb-3">
    <label for="instructions" class="form-label">Instructions:</label>
    <textarea name="instructions" id="instructions" class="form-control" required></textarea>
  </div>

  <div class="mb-3">
    <label for="image" class="form-label">Image URL:</label>
    <input type="text" name="image" id="image" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Add Recipe</button>

</form>
</main>

<footer>

 <!-- Footer with: website address and email and my name, email and student id number  -->
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
