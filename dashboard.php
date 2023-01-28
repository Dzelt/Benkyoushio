<?php

require("function.php");

if (!isset($_SESSION["user"])) {
    header("location: index.php");
    exit();
}
if ($_SESSION["user_type"] != 2) {
    header("location: admin-dashboard.php");
    exit();
}

// if (isset($_SESSION["user"])) {
//     if ($_SESSION["user_type"] != 2) {
//         header("location: index.php");
//     }
// }

if (isset($_GET["logout"])) {
    logoutUser();
}

print_r($_SESSION);

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Benkyoushio - Dashboard</title>
    <!-- Favicon -->
    <link rel="icon" href="./picture/favicon.png">
    <!--Use this css for Navigation bar and footer-->
    <link rel="stylesheet" href="./style/general.css">
    <!--Always needed in any page-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Always needed in any page-->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fas fa-bars"></i>
        </label>
        <a href="index.php"><img class="logo" src="./picture/logo.png" alt="image is not available"></a>
        <ul class="menubtn">
            <li><a class="navbtn" href="./quiz/quiz-dashboard.php">Quiz</a></li>
            <li><a class="navbtn" href="#">Forum</a></li>
            <li><a class="navbtn" href="?logout">Log Out</a></li>
        </ul>
    </nav>
    <div class="page-title">
        <h1>Dashboard</h1>
    </div>
    <div class="wrapper">
        <div class="text1">
            <h3 align="center">Welcome <?php echo $_SESSION["user"] ?></h3>
            <br></br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.</p>
        </div>
        <br></br>
        <div class="text1">
            <h3 align="center">New</h3>
            <br></br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Sit amet risus nullam eget felis eget nunc. Id faucibus nisl tincidunt eget nullam
                non. Semper feugiat nibh sed pulvinar proin gravida. Etiam erat velit scelerisque in dictum non
                consectetur a erat. Ut lectus arcu bibendum at varius vel pharetra vel. Fames ac turpis egestas sed
                tempus urna. Aliquam sem et tortor consequat id porta nibh venenatis. Sed odio morbi quis commodo odio.
                Id ornare arcu odio ut sem nulla pharetra diam. Elementum nisi quis eleifend quam adipiscing. Amet
                cursus sit amet dictum sit amet justo donec enim. A pellentesque sit amet porttitor eget. At volutpat
                diam ut venenatis. Ornare quam viverra orci sagittis eu volutpat. Sit amet mauris commodo quis imperdiet
                massa tincidunt nunc pulvinar. Enim praesent elementum facilisis leo vel fringilla est ullamcorper.
                Volutpat maecenas volutpat blandit aliquam etiam erat velit scelerisque. Et tortor at risus viverra.
                Dolor magna eget est lorem.

                Consequat id porta nibh venenatis cras sed. Nisl nunc mi ipsum faucibus vitae aliquet nec ullamcorper.
                Quis imperdiet massa tincidunt nunc pulvinar sapien. Integer vitae justo eget magna fermentum iaculis eu
                non diam. Nisi scelerisque eu ultrices vitae auctor eu augue ut. Sit amet luctus venenatis lectus magna.
                Libero volutpat sed cras ornare arcu. Augue mauris augue neque gravida in fermentum et sollicitudin.
                Ornare suspendisse sed nisi lacus sed viverra tellus in. Tempus quam pellentesque nec nam aliquam sem et
                tortor consequat. Purus sit amet volutpat consequat mauris nunc congue nisi.

                Elit ut aliquam purus sit amet luctus venenatis. Tristique senectus et netus et malesuada. Sed lectus
                vestibulum mattis ullamcorper velit sed ullamcorper morbi. Vitae auctor eu augue ut lectus arcu bibendum
                at. Pretium aenean pharetra magna ac placerat vestibulum lectus. Velit sed ullamcorper morbi tincidunt
                ornare. Libero nunc consequat interdum varius sit amet mattis. Morbi tristique senectus et netus. Sed
                vulputate odio ut enim blandit. Dolor sit amet consectetur adipiscing elit ut aliquam. Consectetur purus
                ut faucibus pulvinar elementum integer enim. In eu mi bibendum neque egestas congue.

                At risus viverra adipiscing at in tellus integer. Enim ut sem viverra aliquet. Vulputate mi sit amet
                mauris commodo quis. Turpis egestas sed tempus urna et pharetra pharetra. Viverra tellus in hac
                habitasse platea dictumst vestibulum. Nec feugiat nisl pretium fusce. Ut faucibus pulvinar elementum
                integer enim neque. Gravida dictum fusce ut placerat orci nulla. Urna nunc id cursus metus aliquam. Id
                leo in vitae turpis massa sed elementum tempus. Nisl nisi scelerisque eu ultrices vitae auctor eu. Dolor
                sit amet consectetur adipiscing elit pellentesque habitant morbi. Amet nulla facilisi morbi tempus. Id
                leo in vitae turpis massa sed elementum. Tellus at urna condimentum mattis pellentesque id nibh tortor.
                Sed cras ornare arcu dui vivamus arcu felis bibendum ut. Ut ornare lectus sit amet est placerat in.

                Ipsum a arcu cursus vitae congue mauris rhoncus aenean. Praesent semper feugiat nibh sed pulvinar proin
                gravida hendrerit lectus. Sed euismod nisi porta lorem mollis aliquam. Ut porttitor leo a diam
                sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames. Risus nullam
                eget felis eget nunc lobortis mattis. Tempor nec feugiat nisl pretium fusce. Praesent elementum
                facilisis leo vel fringilla est. Mattis ullamcorper velit sed ullamcorper. Porttitor massa id neque
                aliquam vestibulum morbi blandit cursus risus. Tempor orci eu lobortis elementum nibh tellus. Ante in
                nibh mauris cursus. Lectus proin nibh nisl condimentum id venenatis a. Eget arcu dictum varius duis at
                consectetur. Odio pellentesque diam volutpat commodo sed egestas. Viverra suspendisse potenti nullam ac
                tortor vitae purus faucibus ornare. Ut sem viverra aliquet eget sit amet tellus.</p>
        </div>
    </div>

    <footer align="center">
        <div class="footer-content">
            <ul>
                <li><a class="navbtn" href="../about/about_lecture.html">About Lecture</a></li> |
                <li><a class="navbtn" href="../about/about_us.html">About Us</a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>Copyright &copy;2022 Benkyoushio.</p>
        </div>
    </footer>
</body>



</html>