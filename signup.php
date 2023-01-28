<?php
require "function.php";

if (isset($_SESSION["user"])) {
    header("location: dashboard.php");
    exit();
}

if (isset($_POST['submit'])) {
    $response = registerUser($_POST['user_type'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirm-password']);
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benkyoushio - Sign Up</title>
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
    <div class="container1">
        <?php
        if (@$response == "success") {
        ?>
            <h1>Registration Complete</h1>
        <?php
        } else {
        ?>
            <h1><?php echo @$response; ?></h1>
            <br><br>
        <?php
        }
        ?>
        <div class="signup-box">
            <h1>Sign Up</h1>
            <h4>It's free and only takes a minute</h4>
            <form action="" method="post" autocomplete="off">
                <input type="hidden" name="user_type" value="2">
                <label for="">Email *</label>
                <input type="text" name="email" value="<?php echo @$_POST['email'] ?>">
                <label for="">Username *</label>
                <input type="text" name="username" value="<?php echo @$_POST['username'] ?>">
                <label for="">Password *</label>
                <input type="password" name="password" value="<?php echo @$_POST['password'] ?>">
                <label for="">Confirm Password *</label>
                <input type="password" name="confirm-password" value="<?php echo @$_POST['confirm-password'] ?>">
                <button class="btn-1" type="submit" name="submit">Submit</button>
            </form>
            <p class="para-2">
                By clicking the Submit button, you are agree to out <br>
                <a href="#">Terms and Condition</a> and <a href="#">Privacy and Policy</a>
            </p>
        </div>
        <p>
            Already have an account? <a href="login.php">Login here</a>
        </p>
    </div>
    <footer align="center">
        <div class="footer-bottom">
            <p>Copyright &copy;2022 Benkyoushio.</p>
        </div>
    </footer>
</body>

</html>