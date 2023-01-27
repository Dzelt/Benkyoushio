<?php
require "function.php";

if (isset($_SESSION["user"])) {
    header("location: dashboard.php");
    exit();
}

if (isset($_POST['submit'])) {
    $response = registerAdmin($_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirm-password']);
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
        <div class="signup-box">
            <h1>Sign Up</h1>
            <h4>It's free and only takes a minute</h4>
            <form action="" method="post" autocomplete="off">
                <label for="">Email *</label>
                <input type="text" name="email" value="<?php echo @$_POST['email'] ?>">
                <label for="">Admin Name*</label>
                <input type="text" name="username" value="<?php echo @$_POST['username'] ?>">
                <label for="">Password *</label>
                <input type="password" name="password" value="<?php echo @$_POST['password'] ?>">
                <label for="">Confirm Password *</label>
                <input type="password" name="confirm-password" value="<?php echo @$_POST['confirm-password'] ?>">
                <button class="btn-1" type="submit" name="submit">Submit</button>
            </form>
        </div>
        <p>
            Already have an account? <a href="admin-login.php">Login here</a>
        </p>

        <?php
        if (@$response == "success") {
        ?>
            <p class="success">Registration Complete</p>
        <?php
        } else {
        ?>
            <p class="error"><?php echo @$response; ?></p>
        <?php
        }
        ?>

    </div>
    <footer align="center">
        <div class="footer-bottom">
            <p>Copyright &copy;2022 Benkyoushio.</p>
        </div>
    </footer>
</body>

</html>