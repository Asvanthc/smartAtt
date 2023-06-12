<style>
    /* Custom CSS styles for aesthetic design */
    body {
        background-color: #f1f1f1;
        font-family: 'Lato', sans-serif;
    }

    .success-message {
        background-color: #8E0E00;
        color: #ffffff;
        padding: 20px;
        text-align: center;
        border-radius: 5px;
        margin-top: 20px;
        font-size: 18px;
        font-size: 300%;
    }
    /* Custom CSS styles for the button */
    .centered-button {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50px;
        width: 150px;
        background-color: #8E0E00;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
    }
</style>
<?php
// process_form.php

// Database connection configuration
$host = 'localhost';
$dbname = 'sap';
$username = 'root';
$password = '';

// Create a connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the course ID from the form
    $courseID = $_POST['course_id'];

    // Generate a random code
    $randomCode = generateRandomCode(8); // Adjust the code length if needed

    // Prepare and execute the SQL statement to insert the code into the table
    $stmt = $conn->prepare("INSERT INTO random (random_id, course) VALUES (:code, :course_id)");
    $stmt->bindParam(':course_id', $courseID);
    $stmt->bindParam(':code', $randomCode);
    $stmt->execute();

    // Display the code
    echo '<div class="success-message">';
    echo 'Code generated and uploaded successfully!';
    echo '<br>';
    echo 'Generated Code: ' . $randomCode;
    echo '</div> <br><br><center><a href="teacher_menu.html"><button class="centered-button">Go Back.</button></center>';
}

// Function to generate a random code
function generateRandomCode($length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $code = '';
    $charLength = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[mt_rand(0, $charLength)];
    }

    return $code;
}
?>