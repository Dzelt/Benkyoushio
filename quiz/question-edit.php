<?php

require("../function.php");
require("quiz-function.php");

if (!isset($_SESSION["user"])) {
    header("location: ../index.php");
    exit();
}

if (isset($_GET["logout"])) {
    logoutUser();
}

if (isset($_POST['edit_question'])) {
    $response = editQuestion($_POST['id'], $_POST['text']);
}

if (isset($_POST['add_option'])) {
    $response = addOption($_POST['question_id'], $_POST['text']);
}

if (isset($_POST['choose_ans'])) {
    $response = updateTrueAns($_POST['quiz_id'], $_POST['question_id'], $_POST['option_id']);
}


$quiz_id = $_SESSION['Quiz_id'];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Benkyoushio - Question Edit</title>
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
            <li><a class="navbtn" href="quiz-management.php">Quiz</a></li>
            <li><a class="navbtn" href="?logout">Log Out</a></li>
        </ul>
    </nav>
    <div class="page-title">
        <h1>Question Edit
            <a href="quiz-question-list.php?id=<?= $quiz_id; ?>" class="btn btn-danger">BACK</a>
        </h1>
    </div>

    <div class="container mt-5">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Question
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $con = connect();
                        if (isset($_GET['id'])) {
                            $id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM quiz_question WHERE id='$id' ";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $quiz_question = mysqli_fetch_array($query_run);
                        ?>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label>Question Text</label>
                                        <input type="hidden" name="id" value=<?= $quiz_question['id']; ?>>
                                        <input type="text" name="text" value="<?= $quiz_question['text']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="edit_question" name="edit_question" class="btn btn-primary">Updated Question</button>
                                    </div>
                                </form>
                        <?php
                            } else {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 md-5">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Options
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $con = connect();
                        if (isset($_GET['id'])) {
                            $id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM question_option WHERE question_id='$id' ";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 3) {
                                $question_option = mysqli_fetch_array($query_run);
                        ?>
                                <table class="table table-bordered table-striped">
                                    <colgroup>
                                        <col width="80%">
                                        <col width="20%">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>Options</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM question_option WHERE question_id='$id'";
                                        $query_run = mysqli_query($con, $query);
                                        foreach ($query_run as $question_option) {
                                        ?>
                                            <tr>
                                                <td><?= $question_option['text']; ?></td>
                                                <td>
                                                    <a href="option-edit.php?id=<?= $question_option['id']; ?>" class="btn btn-success btn-sm">Edit Option</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                                $result = $con->query("SELECT * FROM true_answer WHERE question_id = $id")->fetch_array();
                                if ($result != NULL) {
                                    $choosen_id = $result['option_id'];
                                    $choosen_option = "SELECT * FROM question_option WHERE id='$choosen_id' ";
                                    $arr = mysqli_query($con, $choosen_option);
                                    $the_choosen_option = mysqli_fetch_assoc($arr);
                                ?>
                                    <div class="col-md-12 alert alert-primary">The correct choosen option was : <?= $the_choosen_option['text']; ?>.</div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-md-12 alert alert-danger">Plese select the answer.</div>
                                <?php
                                }
                                ?>
                                <div class="container mt-1">
                                    <?php
                                    $query = "SELECT * FROM true_answer WHERE question_id='$id' ";
                                    $result = mysqli_query($con, $query);
                                    ?>
                                    <h4>Choose or edit answer.</h4>
                                    <?php
                                    $query = "SELECT * FROM question_option WHERE question_id='$id' ";
                                    $result = mysqli_query($con, $query);
                                    ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="quiz_id" value="<?= $quiz_id; ?>">
                                        <input type="hidden" name="question_id" value=<?= $id; ?>>
                                        <select name="option_id">
                                            <?php
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id']}'>{$row['text']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <button type="choose_ans" name="choose_ans" class="btn btn-primary mt-2">Submit</button>
                                        <a href="quiz-question-list.php?id=<?= $quiz_id; ?>" class="btn btn-danger">BACK</a>
                                    </form>
                                </div>
                            <?php
                            } else {
                                echo "<h4>No option or few options found, please add more options below:</h4>";
                                $id = mysqli_real_escape_string($con, $_GET['id']);
                            ?>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <input type="hidden" name="question_id" value="<?= $id; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Option</label>
                                        <input type="text" name="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="add_option" name="add_option" class="btn btn-primary mt-2">Add Options</button>
                                    </div>
                                </form>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>