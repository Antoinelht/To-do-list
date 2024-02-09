<?php
// Define database connection constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'mytable');

// Log the database connection string for debugging purposes
error_log("mysql:host=".DB_HOST.";dbname=".DB_NAME);

// Log the POST data for debugging purposes
error_log(print_r($_POST, 1));

// Function to connect to the database using PDO
function connectDB() {
    try {
        // Create a new PDO instance
        $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
        // Set the PDO error mode to exception
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Return the database handle
        return $dbh;
    } catch (PDOException $e) {
        // Exit the script and print an error message if a PDOException is caught
        exit("Error: " . $e->getMessage());
    }
}

// Function to create a new task in the database
function createTask($name) {
    // Connect to the database
    $dbh = connectDB();
    // SQL query to insert a new task
    $sql = "INSERT INTO mytable (name) VALUES (:name)";
    try {
        // Prepare the SQL query
        $query = $dbh->prepare($sql);
        // Bind the 'name' parameter to the SQL query
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        // Execute the SQL query
        $query->execute();
        // Print a success message
        echo " $name, l'insertion a réussi.";
    } catch (PDOException $e) {
        // Exit the script and print an error message if a PDOException is caught
        exit("Error: " . $e->getMessage());
    }
}

// Function to display all tasks from the database
function displayTasks() {
    // Connect to the database
    $dbh = connectDB();
    // SQL query to select all tasks
    $sql = "SELECT * FROM mytable";
    try {
        // Execute the SQL query and fetch all tasks
        foreach ($dbh->query($sql) as $row) {
            // Print the task name
            echo "<p style='font-size:26px;'>".$row['name']."</p>";
            // Print a form to delete the task
            echo "<form action='index.php' method='post'>
                    <input type='hidden' name='delete_id' value='".$row['id']."'>
                    <input type='submit' value='Supprimer'class='btn btn-danger'>
                  </form>";
            echo "<br/>";
        }
    } catch (PDOException $e) {
        // Exit the script and print an error message if a PDOException is caught
        exit("Error: " . $e->getMessage());
    }
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a new task is being created
    if (isset($_POST["task"])) {
        createTask($_POST["task"]);
    // Check if a task is being deleted
    } else if (isset($_POST["delete_id"])) {
        deleteTask($_POST["delete_id"]);
    }
}

// Function to delete a task from the database
function deleteTask($id) {
    // Connect to the database
    $dbh = connectDB();
    // SQL query to delete a task
    $sql = "DELETE FROM mytable WHERE id = :id";
    try {
        // Prepare the SQL query
        $query = $dbh->prepare($sql);
        // Bind the 'id' parameter to the SQL query
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        // Execute the SQL query
        $query->execute();
        // Print a success message
        echo "La tâche a été supprimée avec succès.";
    } catch (PDOException $e) {
        // Exit the script and print an error message if a PDOException is caught
        exit("Error: " . $e->getMessage());
    }
}
?>