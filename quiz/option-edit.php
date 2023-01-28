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

if (isset($_POST['edit_option'])) {
    $response = editOption($_POST['id'], $_POST['text']);
}

print_r($_SESSION);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Benkyoushio - Option Edit</title>
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
        <h1>Option Edit
            <a href="quiz-management.php" class="btn btn-danger float">Back</a>
        </h1>
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
                            $query = "SELECT * FROM question_option WHERE id='$id' ";
                            $query_run = mysqli_query($con, $query);
                            $question_option = mysqli_fetch_array($query_run);
                        ?>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <input type="hidden" name="id" value="<?= $id; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Option</label>
                                    <input type="text" name="text" value="<?= $question_option['text']; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="edit_option" name="edit_option" class="btn btn-primary mt-2">Edit Options</button>
                                </div>
                            </form>
                        <?php
                        } else {
                            echo "<h4>Unable to obtain obtion data!</h4>";
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