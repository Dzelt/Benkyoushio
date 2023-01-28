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

if (isset($_POST['add_question'])) {
    $response = addQuestion($_POST['quiz_id'], $_POST['text']);
}

if (isset($_POST['delete_question'])) {
    $response = deleteQuestion($_POST['question_id']);
}

print_r($_SESSION);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Benkyoushio - Quiz Question List</title>
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
            <li><a class="navbtn" href="quiz-management.html">Quiz</a></li>
            <li><a class="navbtn" href="?logout">Log Out</a></li>
        </ul>
    </nav>
    <div class="page-title">
        <a href="quiz-management.php" class="btn btn-danger">BACK</a>
    </div>

    <?php
    $conn = connect();
    $qry = $conn->query("SELECT * FROM quiz where id = " . $_GET['id'])->fetch_array();
    ?>

    <div class="container mt-5">
        <div class="col-md-12 alert alert-primary"><?php echo $qry['title'] ?> question list.</div>
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>New Question</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        $con = connect();
                        if (isset($_GET['id'])) {
                            $quiz_id = mysqli_real_escape_string($con, $_GET['id']);
                        ?>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <input type="hidden" name="quiz_id" value="<?= $quiz_id; ?>">
                                    <label>Question Text</label>
                                    <input type="text" name="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="add_question" name="add_question" class="btn btn-primary">Add New Question</button>
                                </div>
                            </form>
                        <?php
                        } else {
                            echo "<h4>No Such Id Found</h4>";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Question list
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <colgroup>
                                <col width="80%">
                                <col width="20%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $con = connect();
                                if (isset($_GET['id'])) {
                                    $quiz_id = mysqli_real_escape_string($con, $_GET['id']);
                                    $query = "SELECT * FROM quiz_question WHERE quiz_id = '$quiz_id'";
                                    $query_run = mysqli_query($con, $query);
                                }
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $quiz_question) {
                                ?>
                                        <tr>
                                            <td><?= $quiz_question['text']; ?></td>
                                            <td>
                                                <a href="question-edit.php?id=<?= $quiz_question['id']; ?>" class="btn btn-success btn-sm">Edit Question</a>
                                                <form action="" method="POST" class="d-inline">
                                                    <input type="hidden" name="question_id" value="<?= $quiz_question['id']; ?>">
                                                    <button type="submit" name="delete_question" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>