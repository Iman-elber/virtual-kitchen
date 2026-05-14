<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Update Recipe</title>

    <!--Favicon is the logo of Virtual Kitchen-->
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

<main>
    <?php
session_start();
require 'connectdb.php';

// Ensure user is logged in
if (!isset($_SESSION['uid'])) {
    die("Access denied. You must be logged in to update a recipe. <a href='login.php'>Login</a>");
}

// Fetch all recipes for the user
$stmt = $db->prepare("SELECT rid, name FROM recipes WHERE uid = ?");
$stmt->execute([$_SESSION['uid']]);
$recipes = $stmt->fetchAll();

// Load form only if recipe ID is in URL
$recipe = null;
if (isset($_GET['rid'])) {
    $rid = $_GET['rid'];

    // Fetch selected recipe to edit
    $stmt = $db->prepare("SELECT * FROM recipes WHERE rid = ? AND uid = ?");
    $stmt->execute([$rid, $_SESSION['uid']]);
    $recipe = $stmt->fetch();

    if (!$recipe) {
        echo "<p style='color:red;'> Recipe not found or you do not have permission to edit it.</p>";
    }
}

// If the form has been submitted, update the recipe
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $recipe) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $cookingtime = $_POST['cookingtime'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $image = $_POST['image'];

    $sql = "UPDATE recipes SET name = ?, description = ?, type = ?, cookingtime = ?, ingredients = ?, instructions = ?, image = ? WHERE rid = ? AND uid = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$name, $description, $type, $cookingtime, $ingredients, $instructions, $image, $rid, $_SESSION['uid']]);

    echo "<p style='color:green;'><strong> Recipe updated successfully!</strong></p>";

    // Refresh the form with updated values
    $stmt = $db->prepare("SELECT * FROM recipes WHERE rid = ? AND uid = ?");
    $stmt->execute([$rid, $_SESSION['uid']]);
    $recipe = $stmt->fetch();
}
?>


<!-- Display the update form with existing recipe -->
<h1>Update Recipe</h1>
<ul>
    <?php foreach ($recipes as $r): ?>
        <li>
           <h2> <?php echo htmlspecialchars($r['name']); ?>:
             <a href="update_recipe.php?rid=<?php echo $r['rid']; ?>">Edit</a> </h2>
        </li>
    <?php endforeach; ?>
</ul>

<?php if ($recipe): ?>
    <form method="POST" class="container mt-4">
  <div class="mb-3">
    <label for="name" class="form-label">Recipe Name:</label>
    <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($recipe['name']); ?>" required>
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Description:</label>
    <textarea name="description" id="description" class="form-control" required><?php echo htmlspecialchars($recipe['description']); ?></textarea>
  </div>

  <div class="mb-3">
    <label for="type" class="form-label">Type:</label>
    <select name="type" id="type" class="form-select" required>
      <option value="French" <?php if ($recipe['type'] == 'French') echo 'selected'; ?>>French</option>
      <option value="Italian" <?php if ($recipe['type'] == 'Italian') echo 'selected'; ?>>Italian</option>
      <option value="Chinese" <?php if ($recipe['type'] == 'Chinese') echo 'selected'; ?>>Chinese</option>
      <option value="Indian" <?php if ($recipe['type'] == 'Indian') echo 'selected'; ?>>Indian</option>
      <option value="Mexican" <?php if ($recipe['type'] == 'Mexican') echo 'selected'; ?>>Mexican</option>
      <option value="Others" <?php if ($recipe['type'] == 'Others') echo 'selected'; ?>>Others</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="cookingtime" class="form-label">Cooking Time (minutes):</label>
    <input type="number" name="cookingtime" id="cookingtime" class="form-control" value="<?php echo htmlspecialchars($recipe['Cookingtime']); ?>" required>
  </div>

  <div class="mb-3">
    <label for="ingredients" class="form-label">Ingredients:</label>
    <textarea name="ingredients" id="ingredients" class="form-control" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea>
  </div>

  <div class="mb-3">
    <label for="instructions" class="form-label">Instructions:</label>
    <textarea name="instructions" id="instructions" class="form-control" required><?php echo htmlspecialchars($recipe['instructions']); ?></textarea>
  </div>

  <div class="mb-3">
    <label for="image" class="form-label">Image URL:</label>
    <input type="text" name="image" id="image" class="form-control" value="<?php echo htmlspecialchars($recipe['image']); ?>">
  </div>

  <button type="submit" class="btn btn-primary">Update Recipe</button>
</form>

<?php else: ?>
    <p> Click on a recipe name to edit it.</p>
<?php endif; ?>
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
