<?php
include('header.php');

if (isset($_POST['submit_mult'])) {{
  // Retrieve selected record IDs from checkboxes
  $selectedIDs = isset($_POST['selector']) ? $_POST['selector'] : [];
  $courseID = isset($_POST['course_id']) ? strtoupper($_POST['course_id']) : '';

  if (isset($_POST['teacher_id'])) {
    $teacherId = $_POST['teacher_id'];
    // Use the retrieved teacher_id as needed
    echo "The teacher_id is: " . $teacherId;
}
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "sap";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Insert selected record IDs into attendance table
  foreach ($selectedIDs as $id) {
    $id = intval($id); // Convert to integer for security

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO `attendance`(`id`,  `teacher_id`, `date`, `course_id`, `attendance`) VALUES ($id,' $teacherId',NOW(),'$courseID','P');";
    if ($conn->query($sql) !== TRUE) 
      echo "Error inserting record ID $id into attendance table: " . $conn->error;
    }
  }

  // Check for unselected records and insert them as absent in the attendance table
  $unselectedIDs = array_diff(getAllStudentIDs(), $selectedIDs);
  foreach ($unselectedIDs as $id) {
    $id = intval($id); // Convert to integer for security

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO `attendance`(`id`,  `teacher_id`, `date`, `course_id`, `attendance`) VALUES ($id,' $teacherId ',NOW(),'$courseID','A');";
    if ($conn->query($sql) !== TRUE) {
      echo "Error inserting absent record for ID $id into attendance table: " . $conn->error;
    }
  }

  // Close the database connection
  $conn->close();

  // Redirect back to main.php with success message as a query parameter
  header("Location: teacher-student-view.php?success=1");
  exit();
}

// Helper function to retrieve all student IDs
// Helper function to retrieve all student IDs
function getAllStudentIDs() {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "sap";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $myVariable = $_SESSION['user_id'];

  // Use the retrieved session variable
  echo "The value of myVariable is: " . $myVariable;
  // Retrieve all student IDs from the students table
  $sql = "SELECT `user_id` FROM `students`";
  $result = $conn->query($sql);

  $studentIDs = [];
  while ($row = $result->fetch_assoc()) {
    $studentIDs[] = $row['user_id'];
  }

  // Close the database connection
  $conn->close();

  return $studentIDs;
}

?>
