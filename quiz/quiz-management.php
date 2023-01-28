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

if (isset($_POST['add_quiz'])) {
    $response = addQuiz($_POST['title']);
}

if (isset($_POST['delete_quiz'])) {
    $response = deleteQuiz($_POST['quiz_id']);
}

print_r($_SESSION);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Benkyoushio - Quiz Managment</title>
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
        <h1>Quiz Management</h1>
    </div>

    <div class="container mt-5">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Quiz Title
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label>Quiz Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="add_quiz" class="btn btn-primary">Add New Title</button>
                            </div>
                        </form>
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
                        <h4>Quiz list
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <colgroup>
                                <col width="79%">
                                <col width="21%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>Quiz Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $con = connect();
                                $query = "SELECT * FROM quiz";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $quiz) {
                                ?>
                                        <tr>
                                            <td><?= $quiz['title']; ?></td>
                                            <td>
                                                <a href="quiz-question-list.php?id=<?= $quiz['id']; ?>" class="btn btn-info btn-sm">View Question</a>
                                                <a href="quiz-edit.php?id=<?= $quiz['id']; ?>" class="btn btn-success btn-sm">Edit Title</a>
                                                <form action="" method="POST" class="d-inline">
                                                    <input type="hidden" name="quiz_id" value="<?= $quiz['id']; ?>">
                                                    <button type="submit" name="delete_quiz" class="btn btn-danger btn-sm">Delete</button>
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
    <footer align="center">
        <div class="footer-bottom">
            <p>Copyright &copy;2022 Benkyoushio.</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>