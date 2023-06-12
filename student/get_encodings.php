<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student menu</title>


    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <script src="https://kit.fontawesome.com/b8c6c27289.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Merienda+One&family=Permanent+Marker&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/main.min.css">
    <!-- fonts -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&family=Yesteryear&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/2312f8d79b.js"></script><script src="https://use.fontawesome.com/2312f8d79b.js"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <style>
        h1 {
            text-align: center;
            font-family: Arial, sans-serif;
            color: #333333;
            margin-bottom: 20px;
        }

        #attendee-info {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        p {
            margin: 10px 0;
            font-family: Arial, sans-serif;
            color: #666666;
        }

        span {
            font-weight: bold;
        }
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
    
    body {
        font-family: 'Lato', sans-serif;
    }</style>
    </style>
</head>


<body  style="background: #EFEFBB;">

    <!-- navbar -->
    <div id="navbox">
        <br>
        <nav class="navbar navbar-expand-lg navbar-light "><br>
            <h2>
                <a href="../index.html" style="text-decoration: none; color:royalblue"><img style="margin-top: -30x;margin-left: 30px;" src="../images/hom.png" height="70px"></a>

            </h2>
            <span style="margin-top:-5px;font-size: 33px;font-weight: bold; color:royalblue;">SMART ATTENDANCE PORTAL</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item" style="align-items: right;">
                        <a class="nav-link" href="student_menu.html">Home</a>
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

    <!--banner -->
    <h1>Mark Attendance</h1>
    <div id="attendee-info" style="background: #EFEFBB;">
    <center>
        <p style="font-size:40px">Name: <span id="attendee-name"></span></p>
        <p style="font-size:40px">ID: <span id="attendee-id"></span></p>

        <input id="course_code" type="text" placeholder="Enter Course Code" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 16px; width: 250px;">
        <br><br><input id="verification_code" type="text" placeholder="Enter verification Code" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 16px; width: 250px;">
<br><br>
<button class="centered-button">Submit</button>
<center>*run the Python program in background</center>
</center>
    </div>
    
    <script>
        const attendeeNameElem = document.getElementById('attendee-name');
        const attendeeIdElem = document.getElementById('attendee-id');

        // Initialize a WebSocket connection to receive recognized faces from the Python script
        const socket = new WebSocket('ws://localhost:5000');

        // Connection opened
        socket.addEventListener('open', (event) => {
            console.log('WebSocket connection opened:', event);
        });

        // Listen for messages
        socket.addEventListener('message', (event) => {
            console.log('Message from server:', event.data);
            try {
                const data = JSON.parse(event.data);
                attendeeNameElem.textContent = data.name;
                attendeeIdElem.textContent = data.id;
            } catch (error) {
                console.error('Error parsing JSON:', error);
                console.log('Raw server response:', event.data);
            }
        });

        // Connection closed
        socket.addEventListener('close', (event) => {
            console.log('WebSocket connection closed:', event);
        });

        // Connection error
        socket.addEventListener('error', (event) => {
            console.log('WebSocket error:', event);
        });

        // Select the HTML elements
        var courseCodeInput = document.querySelector("#course_code");
        var verificationCodeInput = document.querySelector("#verification_code");
        var submitButton = document.querySelector(".centered-button");

        // Add event listener to the button
        submitButton.addEventListener("click", function(e) {
            e.preventDefault();
            var courseCode = courseCodeInput.value;
            var verificationCode = verificationCodeInput.value;
            var id = document.querySelector('#attendee-id').textContent;

            // Create a new AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "validate.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Define what happens on successful data submission
            xhr.onload = function(event){
                console.log('Server response:', this.responseText);
                try {
                    if(this.status === 200) {
                        var response = JSON.parse(this.responseText);
                        if(response.status === "success") {
                            alert("Attendance marked successfully.");
                        } else {
                            alert("Failed to mark attendance. Check course code and verification code.");
                        }
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    console.log('Raw server response:', this.responseText);
                }
            };

            // Send the request with the data
            var data = `courseCode=${courseCode}&verificationCode=${verificationCode}&id=${id}`;
            xhr.send(data);
        });
    </script>

</body>
</html>
