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
if (isset($_POST['sub_ans'])) {
    $response = updateUserAns($_POST['question_id'], $_POST['user_id'], $_POST['quiz_id'], $_POST['option_id']);
}
$i = 1;

$con = connect();
$quiz_id = mysqli_real_escape_string($con, $_SESSION['Quiz_id']);


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Benkyoushio - Answer Sheet Page</title>
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
        <a href="quiz-dashboard.php" class="btn btn-danger">BACK</a>
    </div>

    <?php
    $conn = connect();
    $quiz = $conn->query("SELECT * FROM quiz where id = " . $_SESSION['Quiz_id'])->fetch_array();
    ?>
    <div class="container mt-5">
        <div class="col-md-12 alert alert-primary"><?php echo $quiz['title'] ?></div>
        <?php include('message.php'); ?>
    </div>
    <div class="row">
        <div class="col-8 container mt-4">
            <div class="container md-5"> <!-- Start first Column -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <?php
                                $con = connect();
                                $quiz_id = mysqli_real_escape_string($con, $_SESSION['Quiz_id']);
                                $user_id = mysqli_real_escape_string($con, $_SESSION["user_id"]);
                                $question_id = $_GET['id'];
                                $question = $con->query("SELECT * FROM quiz_question WHERE id = '$question_id' AND quiz_id='$quiz_id'")->fetch_array();
                                $option = "SELECT * FROM question_option WHERE question_id='$question_id' ";
                                $q_option = mysqli_query($con, $option);
                                $user_answer = $con->query("SELECT * FROM answer WHERE question_id='$question_id' AND user_id ='$user_id'")->fetch_array();
                                ?>
                                <h4><?= $question['text']; ?></h4>
                            </div>
                            <div class="card-body">
                                <div><!-- Where the option displayed -->
                                    <?php
                                    if ($user_answer != NULL) {
                                        $user_ans_opt_id = $user_answer['option_id'];
                                        $user_choose_option = "SELECT * FROM question_option WHERE id='$user_ans_opt_id' ";
                                        $arr = mysqli_query($con, $user_choose_option);
                                        $user_opt = mysqli_fetch_assoc($arr);
                                    ?>
                                        <div class="col-md-12 alert alert-primary">Your answer saved as <?= $user_opt['text']; ?>.</div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-md-12 alert alert-danger">Plese select the answer.</div>
                                    <?php
                                    }
                                    ?>
                                    <div class="container mt-1">
                                        <label for="">Choose the Answer:</label>
                                        <form action="" method="post">
                                            <input type="hidden" name="question_id" value=<?= $question_id; ?>>
                                            <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                                            <input type="hidden" name="quiz_id" value="<?= $quiz_id; ?>"">
                                            <select name=" option_id">
                                            <?php
                                            while ($options = mysqli_fetch_assoc($q_option)) {
                                                echo "<option value='{$options['id']}'>{$options['text']}</option>";
                                            }
                                            ?>
                                            </select>
                                            <button type="sub_ans" name="sub_ans" class="btn btn-primary mt-2">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 container mt-4"> <!-- right column  -->
            <div class="container mb-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Question list
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <table class="table table-bordered table-striped">

                                        <tbody>
                                            <?php
                                            $con = connect();
                                            if (isset($_SESSION['Quiz_id'])) {
                                                $quiz_id = mysqli_real_escape_string($con, $_SESSION['Quiz_id']);
                                                $query = "SELECT * FROM quiz_question WHERE quiz_id = '$quiz_id'";
                                                $query_run = mysqli_query($con, $query);
                                            }
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $quiz_question) {
                                                    $qid = $quiz_question['id'];
                                            ?>

                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <a class="btn btn-success btn-sm" href="answer-sheet.php?id=<?= $qid; ?>"><?php echo $i++ ?></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "<h5> No Record Found </h5>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </form>
                                <a href="quiz-result.php?id=<?= $quiz['id']; ?>" class="btn btn-info btn-sm">Complete test</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>