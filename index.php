<?php
require("function.php");
if (isset($_SESSION["user"])) {
    header("location: dashboard.php");
    exit();
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Benkyoushio - Home</title>
    <!-- Favicon -->
    <link rel="icon" href="picture/favicon.png">
    <!--Customized style only for index.html-->
    <link rel="stylesheet" href="style/index.css">
    <!--Use this css for Navigation bar and footer-->
    <link rel="stylesheet" href="style/general.css">
    <!--Always needed in any page-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Always needed in any page-->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="banner">
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fa fas fa-bars"></i>
            </label>
            <a href="index.php"><img class="logo" src="picture/logo.png" alt="image is not available"></a>
            <ul class="menubtn">
                <li><a class="navbtn" href="about/about_lecture.html">About Lecture</a></li>
                <li><a class="navbtn" href="about/about_us.html">About Us</a></li>
            </ul>
        </nav>
        <div class="wrapper">
            <div class="textarea1">
                <h1 align="center">Learn Japanese just for free</h1>
                <br><br><br>
                <div class="html_button btn-center">
                    <a href="signup.php" class="btn1">Start learning</a>
                </div>
                <br><br><br>
                <div class="html_button btn-center">
                    <a href="login.php" class="btn2">Log in</a>
                </div>
            </div>
        </div>
    </div>

</body>



</html>