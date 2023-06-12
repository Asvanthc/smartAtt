<?php
// Create a new PDO instance
$host = 'localhost';
$db   = 'sap';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

// Get the data from the AJAX request
$courseCode = $_POST['courseCode'];
$verificationCode = $_POST['verificationCode'];
$id = $_POST['id'];

// Prepare and execute the query
$stmt = $pdo->prepare("SELECT * FROM random WHERE course = :course_id AND random_id = :verification_code");
$stmt->execute(['course_id' => $courseCode, 'verification_code' => $verificationCode]);

// Check if the query returned a result
if ($stmt->rowCount() > 0) {
    // Add code here to update attendance in the database

    $insertStmt = $pdo->prepare("INSERT INTO attendance (id, teacher_id, date, course_id, attendance) VALUES (:id, :teacher_id, :date, :course_id, :attendance)");
    $insertStmt->execute([
        'id' => $id,
        'teacher_id' => 1, // Replace with the actual teacher ID
        'date' => date('Y-m-d'), // Current date
        'course_id' => $courseCode,
        'attendance' => 'P' // Assuming the attendance value to be 'Present'
    ]);


    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "failure"]);
}
?>
