<?php

require("quiz-function.php");

if (!isset($_SESSION["user"])) {
    header("location: ../index.php");
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
    <title>Benkyoushio - Quiz Dashboard</title>
    <!-- Favicon -->
    <link rel="icon" href="../picture/favicon.png">
    <!--Use this css for Navigation bar and footer-->
    <link rel="stylesheet" href="../style/general.css">
    <!--Always needed in any page-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Always needed in any page-->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fas fa-bars"></i>
        </label>
        <a href="../index.php"><img class="logo" src="../picture/logo.png" alt="image is not available"></a>
        <ul class="menubtn">
            <li><a class="navbtn" href="#">Notes</a></li>
            <li><a class="navbtn" href="/quiz/quiz-dashboard.html">Quiz</a></li>
            <li><a class="navbtn" href="#">Forum</a></li>
            <li><a class="navbtn" href="?logout">Log Out</a></li>
        </ul>
    </nav>
    <div class="page-title">
        <h1>Quiz Dashboard</h1>
    </div>
    <div class="wrapper">
        <div class="text1">
            <div class="container-fluid">
                <div class="col-md-12 alert alert-primary">My Quiz List</div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id='table'>
                            <colgroup>
                                <col width="40%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>Quiz</th>
                                    <th>Score</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php
                                        $qry = $conn->query("SELECT * from  quiz_list where id in  (SELECT quiz_id FROM quiz_student_list where user_id ='" . $_SESSION['login_id'] . "' ) order by title asc ");
                                        $i = 1;
                                        if ($qry->num_rows > 0) {
                                            while ($row = $qry->fetch_assoc()) {
                                                $status = $conn->query("SELECT * from history where quiz_id = '" . $row['id'] . "' and user_id ='" . $_SESSION['login_id'] . "' ");
                                                $hist = $status->fetch_array();
                                        ?> -->
                                <tr>
                                    <td>Null</td>
                                    <td>Null</td>
                                    <td>Null</td>
                                    <td>
                                        <center>
                                            <!-- <?php if ($status->num_rows <= 0) : ?> -->
                                            <a class="btn btn-sm btn-outline-primary" href="./answer_sheet.php?id=<?php echo $row['id'] ?>"><i class="fa fa-pencil"></i> Take Quiz</a>
                                            <!-- <?php else : ?> -->
                                            <a class="btn btn-sm btn-outline-primary" href="./view_answer.php?id=<?php echo $row['id'] ?>"><i class="fa fa-eye"></i> View</a>
                                            <!-- <?php endif; ?> -->
                                        </center>
                                    </td>
                                </tr>
                                <!-- <?php
                                            }
                                        }
                                        ?> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br></br>
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

<script>
    $(document).ready(function() {
        $('#table').DataTable();
        $('#new_faculty').click(function() {
            $('#msg').html('')
            $('#manage_faculty .modal-title').html('Add New Faculty')
            $('#manage_faculty #faculty-frm').get(0).reset()
            $('#manage_faculty').modal('show')
        })
        $('.edit_faculty').click(function() {
            var id = $(this).attr('data-id')
            $.ajax({
                url: './get_faculty.php?id=' + id,
                error: err => console.log(err),
                success: function(resp) {
                    if (typeof resp != undefined) {
                        resp = JSON.parse(resp)
                        $('[name="id"]').val(resp.id)
                        $('[name="uid"]').val(resp.uid)
                        $('[name="name"]').val(resp.name)
                        $('[name="subject"]').val(resp.subject)
                        $('[name="username"]').val(resp.username)
                        $('[name="password"]').val(resp.password)
                        $('#manage_faculty .modal-title').html('Edit Faculty')
                        $('#manage_faculty').modal('show')

                    }
                }
            })

        })
        $('.remove_faculty').click(function() {
            var id = $(this).attr('data-id')
            var conf = confirm('Are you sure to delete this data.');
            if (conf == true) {
                $.ajax({
                    url: './delete_faculty.php?id=' + id,
                    error: err => console.log(err),
                    success: function(resp) {
                        if (resp == true)
                            location.reload()
                    }
                })
            }
        })
        $('#faculty-frm').submit(function(e) {
            e.preventDefault();
            $('#faculty-frm [name="submit"]').attr('disabled', true)
            $('#faculty-frm [name="submit"]').html('Saving...')
            $('#msg').html('')

            $.ajax({
                url: './save_faculty.php',
                method: 'POST',
                data: $(this).serialize(),
                error: err => {
                    console.log(err)
                    alert('An error occured')
                    $('#faculty-frm [name="submit"]').removeAttr('disabled')
                    $('#faculty-frm [name="submit"]').html('Save')
                },
                success: function(resp) {
                    if (typeof resp != undefined) {
                        resp = JSON.parse(resp)
                        if (resp.status == 1) {
                            alert('Data successfully saved');
                            location.reload()
                        } else {
                            $('#msg').html('<div class="alert alert-danger">' + resp.msg +
                                '</div>')

                        }
                    }
                }
            })
        })
    })
</script>

</html>