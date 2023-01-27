<?php


// if (isset($_POST['edit_quiz'])) {

//     $mysqli = connect();
//     $id = mysqli_real_escape_string($mysqli, $_POST['id']);
//     $title = mysqli_real_escape_string($mysqli, $_POST['title']);

//     $query = "UPDATE quiz SET title = '$title' WHERE id = '$id' ";
//     $query_run = mysqli_query($mysqli, $query);

//     if ($query_run) {
//         $_SESSION['message'] = "Quiz Updated Successfully";
//         header("Location: quiz-management.php");
//         exit(0);
//     } else {
//         $_SESSION['message'] = "Quiz Not Updated";
//         header("Location: quiz-management.php");
//         exit(0);
//     }
// }

function addQuiz($title)
{
    $mysqli = connect();
    $args = func_get_args();

    $args = array_map(function ($value) {
        return trim($value);
    }, $args);
    foreach ($args as $value) {
        if (empty($value)) {
            return "All fields are required.";
        }
    }
    // for security purpose
    foreach ($args as $value) {
        if (preg_match("/([<\>])/", $value)) {
            return "<> characters are not allowed";
        }
    }
    // Submitting quiz title function
    $stmt = $mysqli->prepare("INSERT INTO quiz(title) VALUES(?)");
    $stmt->bind_param("s", $title);
    $stmt->execute();
    if ($stmt->affected_rows != 1) {
        $_SESSION['message'] = "Quiz Not Created";
        return "An error occured. Try again.";
        exit(0);
    } else {
        $_SESSION['message'] = "Quiz Title Created Successfully";
        return "success";
        exit(0);
    }
}

function editQuiz($id, $title)
{
    $mysqli = connect();
    $stmt = $mysqli->prepare("UPDATE quiz SET title = ? WHERE id = ?");
    $stmt->bind_param("ss", $title, $id);
    $stmt->execute();
    if ($stmt->affected_rows != 1) {
        $_SESSION['message'] = "Connection error!";
        header("Location: quiz-management.php");
        return "An error occured. Try again.";
        exit(0);
    } else {
        $_SESSION['message'] = "Quiz Title Edited Successfully";
        header("Location: quiz-management.php");
        return "success";
        exit(0);
    }
}

function editQuestion($id, $text)
{
    $mysqli = connect();
    $stmt = $mysqli->prepare("UPDATE quiz_question SET text = ? WHERE id = ?");
    $stmt->bind_param("ss", $text, $id);
    $stmt->execute();
    if ($stmt->affected_rows != 1) {
        $_SESSION['message'] = "Connection error!";
        header("Location: question-edit.php");
        return "An error occured. Try again.";
        exit(0);
    } else {
        $_SESSION['message'] = "Quiz Title Edited Successfully";
        header("Location: question-edit.php");
        return "success";
        exit(0);
    }
}

function addQuestion($quiz_id, $text)
{
    $mysqli = connect();
    $args = func_get_args();

    $args = array_map(function ($value) {
        return trim($value);
    }, $args);
    foreach ($args as $value) {
        if (empty($value)) {
            return "All fields are required.";
        }
    }
    // for security purpose
    foreach ($args as $value) {
        if (preg_match("/([<\>])/", $value)) {
            return "<> characters are not allowed";
        }
    }

    // Submitting quiz title function
    $stmt = $mysqli->prepare("INSERT INTO quiz_question(quiz_id, text) VALUES(?,?)");
    $stmt->bind_param("ss", $quiz_id, $text);
    $stmt->execute();
    if ($stmt->affected_rows != 1) {
        $_SESSION['message'] = "Question Not Added!";
        header("quiz-question-list.php");
        return "An error occured. Try again.";
        exit(0);
    } else {
        $_SESSION['message'] = "New Question Successfully Added!";
        header("quiz-question-list.php");
        return "success";
        exit(0);
    }
}

function deleteQuiz($quiz_id)
{
    $mysqli = connect();

    $sql = "DELETE FROM quiz WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $quiz_id);
    $stmt->execute();

    if ($stmt->affected_rows != 1) {
        $_SESSION['message'] = "Quiz Not Deleted!";
        return "An error occured. Try again.";
        exit(0);
    } else {
        $_SESSION['message'] = "Quiz Successfully Deleted!";
        return "success";
        exit(0);
    }
}

function deleteQuestion($question_id)
{
    $mysqli = connect();

    $sql = "DELETE FROM quiz_question WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $question_id);
    $stmt->execute();

    if ($stmt->affected_rows != 1) {
        $_SESSION['message'] = "Quiz Not Deleted!";
        header("Location: quiz-question-list.php");
        return "An error occured. Try again.";
        exit(0);
    } else {
        $_SESSION['message'] = "Quiz Successfully Deleted!";
        header("Location: quiz-question-list.php");
        return "success";
        exit(0);
    }
}

function addOption($question_id, $text, $is_right)
{
    $mysqli = connect();

    // Submitting option function
    $stmt = $mysqli->prepare("INSERT INTO question_option(question_id, text, is_right) VALUES(?,?,?)");
    $stmt->bind_param("sss", $question_id, $text, $is_right);
    $stmt->execute();
    if ($stmt->affected_rows != 1) {
        $_SESSION['message'] = "Option Not Added!";
        header("question-edit.php");
        return "An error occured. Try again.";
        exit(0);
    } else {
        $_SESSION['message'] = "Option Successfully Added!";
        header("question-edit.php");
        return "success";
        exit(0);
    }
}
