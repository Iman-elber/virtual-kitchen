    <?php
    // Recipes.php is a utility file that includes the database connection and defines 3 functions.

    // Connect to the database
    require 'connectdb.php'; 

    // Function 1: fetches one recipe from database using rid
    function getRecipeById($rid) {
        global $db; 

        $stmt = $db->prepare("SELECT * FROM recipes WHERE rid = :rid");
        // PARAM_INT : value is treated as an integer
        $stmt->bindParam(':rid', $rid, PDO::PARAM_INT);
        $stmt->execute();

        // Key-value pairs given as associative array
        return $stmt->fetch(PDO::FETCH_ASSOC);  
    }

    // Function 2: Fetches all recipies
    function getAllRecipes() {
        global $db;

        $stmt = $db->prepare("SELECT * FROM recipes");
        $stmt->execute(); 

        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // Function 3: Search for recipes by name or type
    function searchRecipes($searchTerm) {
        global $db;

        $stmt = $db->prepare("SELECT * FROM recipes WHERE name LIKE :search OR type LIKE :search");
        // Allow partial matches
        $searchTerm = "%$searchTerm%";  
        $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    ?>
