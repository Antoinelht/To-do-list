<!DOCTYPE html> <!-- Defines the document type and version of HTML -->
<html lang="en"> <!-- Starts an HTML document with English language -->

<head> <!-- Contains meta-information about the document -->
    <meta charset="UTF-8"> <!-- Defines the character set for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Makes the webpage responsive on different devices -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> <!-- Links Bootstrap CSS for styling -->
</head>

<body> <!-- Contains the content that will be visible to the user -->
    <style> 
        body {
            font-family: Arial, sans-serif; /* Sets the font of the body */
            background: linear-gradient(#e66465, #9198e5); /* Sets a gradient background */
            margin: 0; /* Removes the margin */
            padding: 0; /* Removes the padding */
            box-sizing: border-box; /* Includes padding and border in the element's total width and height */
        }

        .todo-container {
            max-width: 400px; /* Sets the maximum width of the container */
            margin: 50px auto; /* Centers the container */
            background-color: linear-gradient(0.25turn, #3f87a6, #ebf8e1, #f69d3c); /* Sets a gradient background */
            padding: 20px; /* Adds padding */
            border-radius: 8px; /* Rounds the corners */
            box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.1); /* Adds a shadow */
        }

        h1 {
            text-align: center; /* Centers the text */
        }
    </style>

    <div class="todo-container"> <!-- Container for the to-do list -->
        <h1>To-Do-List</h1> <!-- Title of the to-do list -->
        <br> <!-- Line break -->
        <h2>Créer une tâche :</h2> <!-- Subtitle -->
        <br> <!-- Line break -->
        <form action="index.php" method="post"> <!-- Form for creating a task -->
            <label for="task">Nom de la tâche:</label> <!-- Label for the task input field -->
            <input type="text" class="btn btn-dark" id="task" name="task"> <!-- Input field for the task -->
            <br> <!-- Line break -->
            <input type="submit"  value="Créer" class="btn btn-primary"> <!-- Submit button for the form -->
        </form>
        <br> <!-- Line break -->
        <h2>Tâches en cours :</h2> <!-- Subtitle for current tasks -->

        <?php
        include 'action.php'; // Includes the PHP file 'action.php'
        displayTasks(); // Calls the function 'displayTasks' from 'action.php'
        ?>
    </div>
</body>
</html>