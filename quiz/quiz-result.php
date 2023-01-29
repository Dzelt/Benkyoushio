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

print_r($_SESSION);

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
    $user_id = $_SESSION['user_id'];

    $query = "SELECT COUNT(id) AS count FROM quiz_question GROUP BY quiz_id = '$quiz_id' LIMIT 1,1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    $qry = "SELECT answer.quiz_id, COUNT(*) as count FROM answer JOIN true_answer ON answer.quiz_id = true_answer.quiz_id AND answer.question_id = true_answer.question_id AND answer.option_id = true_answer.option_id WHERE answer.user_id = '$user_id' AND answer.quiz_id = '$quiz_id' GROUP BY answer.quiz_id";
    $rst = mysqli_query($con, $qry);
    $rw = mysqli_fetch_assoc($rst);



    ?>
    <div class="text1">
        <div class="container">
            <h3>The total question for this quiz: <?= $row['count']; ?></h3>
            <br>
            <?php
            if ($rw['count'] == NULL) {
            ?>
                <h3>The score you got: 0</h3>
            <?php
            } else {
            ?>
                <h3>The score you got: <?= $rw['count']; ?></h3>
            <?php
            }
            ?>

            <a href="quiz-dashboard.php" class="btn btn-danger mt-5">BACK</a>
        </div>
    </div>

</body>

</html>