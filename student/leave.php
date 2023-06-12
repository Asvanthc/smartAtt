<?php
// Retrieve form data
$reason = $_POST['full-name'];
$slot = $_POST['position1'];
$date = $_POST['date'];
$leaveType = $_POST['position'];

// File upload handling
$fileName = $_FILES['file']['name'];
$fileTmpName = $_FILES['file']['tmp_name'];
$fileType = $_FILES['file']['type'];
$fileSize = $_FILES['file']['size'];
$fileData = file_get_contents($fileTmpName);

// Create a new PDO instance (assuming MySQL)
$pdo = new PDO('mysql:host=localhost;dbname=sap', 'root', '');

// Prepare the SQL statement
$sql = "INSERT INTO leave_requests (reason, slot, date, leave_type, file_name, file_type, file_size, file_data) 
        VALUES (:reason, :slot, :date, :leaveType, :fileName, :fileType, :fileSize, :fileData)";
$stmt = $pdo->prepare($sql);

// Bind parameters and execute the statement
$stmt->bindParam(':reason', $reason);
$stmt->bindParam(':slot', $slot);
$stmt->bindParam(':date', $date);
$stmt->bindParam(':leaveType', $leaveType);
$stmt->bindParam(':fileName', $fileName);
$stmt->bindParam(':fileType', $fileType);
$stmt->bindParam(':fileSize', $fileSize);
$stmt->bindParam(':fileData', $fileData, PDO::PARAM_LOB);
$stmt->execute();

// Check if the insertion was successful
if ($stmt->rowCount() > 0) {
    echo "Leave request saved successfully.";
} else {
    echo "Failed to save leave request.";
}
?>
