<!DOCTYPE html>
<html>
  
<head>
    <title>Property added</title>
<!-- CSS -->
<link rel="preconnect" href="https://fonts.gstatic.com">

<script src="https://kit.fontawesome.com/b8c6c27289.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lato&family=Merienda+One&family=Permanent+Marker&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">

<!-- fonts -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&family=Yesteryear&display=swap" rel="stylesheet">
<!-- bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<!-- Icons font CSS-->
<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
<!-- Font special for pages-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

<!-- Vendor CSS-->
<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
<link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

<!-- Main CSS-->
<link href="../css/main.css" rel="stylesheet" media="all">
    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>
</head>
<body>
<div id="navbox">
    <br>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="index.html"><img style="margin-top: -30px;margin-left: 30px;" src="../images/hom.png" height="80px"><span style="margin-left: -2px;margin-top:30px;font-size:50px">Property Managment</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item" style="align-items: right;">
                    <a class="nav-link" href="../index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mailto:asvanthc@gmail.com">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Logout</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
            </form>
        </div>
    </nav>
    <br>
</div>
<center>
<?php
        session_start();
        $conn = mysqli_connect("localhost", "root", "", "prop_mang_system");
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
        $survey_no =  $_REQUEST['survey_no'];
        $owner_id = $_SESSION['user_id'];
        $broker_alloted =  $_REQUEST['broker_alloted'];
        $approved_by = 'A8598';
        $price = $_REQUEST['price'];
        $street =  $_REQUEST['street'];
        $city = $_REQUEST['city'];
        $area =  $_REQUEST['area'];
        $category = $_REQUEST['category'];
        $type = $_REQUEST['type'];
        $status = 'available';
        $prop_tax =  $price * 0.2;
        $authenticity = 'pending';
        $sql = "INSERT INTO property  VALUES ($survey_no, 
            '$owner_id','$broker_alloted','$approved_by',$price,'$street','$city',$area,'$category','$type',
            '$status',$prop_tax,'$authenticity')";
          
        if(mysqli_query($conn, $sql)){
            echo "<h3>Property details added to database successfully.</h3>"; 
  
            echo nl2br("Details of Property Added:\nSurvey Number: $survey_no\nCost: $price\n "
                . "Street: $street\nCity: $city\nBroker Alloted: $broker_alloted");
                header( "refresh:5;url=../owner/owner.php" );
        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($conn);
        }
        mysqli_close($conn);
        ?>
    </center>
</body>
  
</html>