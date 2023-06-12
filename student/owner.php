<?php
session_start();
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
echo '<meta name="description" content="Colorlib Templates">';
echo '<meta name="author" content="Colorlib">';
echo '<meta name="keywords" content="Colorlib Templates">';
echo '';
echo '<!-- Title Page-->';
echo '<title>PMS-Seller Registered Table</title>';
echo '<!-- CSS -->';
echo '<link rel="preconnect" href="https://fonts.gstatic.com">';
echo '';
echo '<script src="https://kit.fontawesome.com/b8c6c27289.js" crossorigin="anonymous"></script>';
echo '<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">';
echo '<link href="https://fonts.googleapis.com/css2?family=Lato&family=Merienda+One&family=Permanent+Marker&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">';
echo '';
echo '<link rel="stylesheet" href="css.css">';
echo '<!-- fonts -->';
echo '';
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
echo '';
echo '<link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&family=Yesteryear&display=swap" rel="stylesheet">';
echo '<!-- bootstrap -->';
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">';
echo '<!-- Icons font CSS-->';
echo '<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">';
echo '<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">';
echo '<!-- Font special for pages-->';
echo '<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">';
echo '';
echo '<!-- Vendor CSS-->';
echo '<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">';
echo '<link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">';
echo '';
echo '<!-- Main CSS-->';
echo '<link href="../css/main.css" rel="stylesheet" media="all">';
echo '</head>';
echo '';
echo '<body style="overflow-x: hidden;">';
echo '';
echo '<!-- navbar -->';
echo '<div id="navbox">';
echo '<br>';
echo '<nav class="navbar navbar-expand-lg navbar-light ">';
echo '<a class="navbar-brand" href="../index.html"><img style="margin-top: -30px;margin-left: 30px;" src="../images/hom.png" height="80px"><span style="margin-left: -2px;margin-top:30px;font-size:50px;">Property Managment</span></a>';
echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">';
echo '<span class="navbar-toggler-icon"></span>';
echo '</button>';
echo '';

echo '<div class="collapse navbar-collapse" id="navbarTogglerDemo02">';
echo '<ul class="navbar-nav ms-auto mt-2 mt-lg-0">';
echo '<li class="nav-item" style="align-items: right;">';
echo '<a class="nav-link" href="../index.html">Home</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="mailto:asvanthc@gmail.com">Contact</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="../index.html">Logout</a>';
echo '</li>';
echo '';
echo '</ul>';
echo '<form class="form-inline my-2 my-lg-0">';
echo '</form>';
echo '</div>';
echo '</nav>';
echo '<br>';
echo '</div>';
echo '';
echo '';
echo '<center>';
echo '<div class="row filter bg"  style=" background: linear-gradient(to right, #a8ff78, #78ffd6);">';
echo '';
echo '<div class=" col-lg-5 mx-auto d-flex justify-content-around mt-5 sortBtn flex-wrap">';
echo '';
echo '';
echo '<a style="margin-left:1px; font-size:37px;">Properties Added By You...</i>';
echo '</div>';
echo '</div>';
echo '';

echo '<div class="page-wrapper bg-gra-03 p-t-45 p-b-50" style=" background: linear-gradient(to right, #a8ff78, #78ffd6);font-size: 18px;">';
echo '<div class="wrapper wrapper--w790" style="">';

echo '<table class="table table-dark table-hover">';
echo '<tr>';
echo '<th style="text-align: center; text-size:15px">Owner ID</th>';
echo '<th style="text-align: center;">Survey Number</th>';
echo '<th style="text-align: center;">Area(acre)</th>';
echo '<th style="text-align: center;">Broker Alloted</th>';
echo '<th style="text-align: center;">Type</th>';
echo '<th style="text-align: center;">Cost</th>';
echo '</tr>';
$link = mysqli_connect("localhost", "root", "", "prop_mang_system");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$user_id = $_SESSION['user_id'];

$_SESSION['user_id'] = $user_id;
 
$sql = "SELECT * FROM owner natural join property where owner_id='$user_id'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td style='text-align: center;'>" . $row['owner_id'] . "</td>";
            echo "<td style='text-align: center;'>" . $row['survey_no'] . "</td>";
            echo "<td style='text-align: center;'>" . $row['area']  . "</td>";
            echo "<td style='text-align: center;'>" . $row['broker_alloted'] . "</td>";
            echo "<td style='text-align: center;'>" . $row['category'] . "</td>";
            echo "<td style='text-align: center;'>" . $row['price'] . "</td>";
            echo "</tr>";
        }
        
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

echo "</table>";

echo '<a class="btn btn-dark btn-lg" style="float: right;" href="/DBMS-PHP/owner/delete.php" role="button">DELETE</a>';
echo '<a class="btn btn-light btn-lg" style="float: left;  color:black"href="/DBMS-PHP/Owner/seller.html" role="button">ADD</a></div>';
echo '</center>';
// Close connection
mysqli_close($link);
?>