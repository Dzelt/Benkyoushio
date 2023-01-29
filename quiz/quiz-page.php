<?php

require("../function.php");
require("quiz-function.php");

if (!isset($_SESSION["user"])) {
    header("location: ../index.php");
    exit();
}

if ($_SESSION["user_type"] != 2) {
    header("location: admin-dashboard.php");
    exit();
}

if (isset($_GET["logout"])) {
    logoutUser();
}

$_SESSION['Quiz_id'] = $_GET['id'];


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Benkyoushio - Quiz Page</title>
    <!-- Favicon -->
    <link rel="icon" href="../picture/favicon.png">
    <!--Use this css for Navigation bar and footer-->
    <link rel="stylesheet" href="../style/general.css">
    <!--Always needed in any page-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Always needed in any page-->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fas fa-bars"></i>
        </label>
        <a href="../index.php"><img class="logo" src="../picture/logo.png" alt="image is not available"></a>
        <ul class="menubtn">
            <li><a class="navbtn" href="quiz-dashboard.php">Quiz</a></li>
            <li><a class="navbtn" href="?logout">Log Out</a></li>
        </ul>
    </nav>
    <div class="page-title">
    </div>
    <?php
    $con = connect();
    $quiz_id = $_SESSION['Quiz_id'];
    $arr = $con->query("SELECT * FROM quiz WHERE id='$quiz_id'")->fetch_array();
    $question = $con->query("SELECT * FROM quiz_question WHERE quiz_id='$quiz_id' LIMIT 1")->fetch_array();
    $question_id = $question['id'];
    ?>
    <div class="mt-5 container">
        <div class="text1 justify-content-center">
            <div class="col-md-12 alert alert-primary">Your are choosing quiz: <?php echo $arr['title'] ?></div>
            <br>
            <a class="btn btn-primary" href="answer-sheet.php?id=<?= $question_id; ?>">Start Quiz</a> <a class="btn btn-danger" href="quiz-dashboard.php">Back</a>
        </div>
    </div>
</body>

</html>