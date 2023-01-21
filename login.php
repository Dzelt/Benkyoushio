<?php
require("function.php");

if (isset($_SESSION["user"])) {
    header("location: dashboard.php");
    exit();
}

if (isset($_POST['submit'])) {
    $response = loginUser($_POST['email'], $_POST['password']);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Benkyoushio - Login</title>
    <link rel="stylesheet" href="Css/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet" />
    <!--Always needed in any page-->
    <link rel="stylesheet" href="style/general.css">
    <!--Always needed in any page-->
    <link rel="stylesheet" href="style/signup.css">
    <!--Always needed in any page-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Always needed in any page-->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="icon" href="picture/favicon.png">
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fas fa-bars"></i>
        </label>
        <a href="index.php"><img class="logo" src="./picture/logo.png" alt="image is not available"></a>
    </nav>
    <div class="container2">
        <div class="login-box">
            <h1>Login</h1>
            <form action="" method="post" autocomplete="off">
                <label for="">Email *</label>
                <input type="text" name="email" value="<?php echo @$_POST['email'] ?>">
                <label for="">Password *</label>
                <input type="password" name="password" value="<?php echo @$_POST['password'] ?>">
                <button class="btn-1" type="Login" name="submit">Submit</button>
            </form>
        </div>
        <p>
            Not have an account? <a href="signup.php">Sign Up Here</a>
        </p>

        <p class="error"><?php echo @$response; ?></p>

    </div>
    <footer align="center">
        <!-- <div class="footer-content">
            <ul>
                <li><a class="navbtn" href="../about/about_lecture.html">About Lecture</a></li> |
                <li><a class="navbtn" href="#">Student List</a></li> |
                <li><a class="navbtn" href="../about/about_us.html">About Us</a></li>
            </ul>
        </div> -->
        <div class="footer-bottom">
            <p>Copyright &copy;2022 Benkyoushio.</p>
        </div>
    </footer>
</body>

</html>