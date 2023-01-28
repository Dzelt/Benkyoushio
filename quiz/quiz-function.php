<?php

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
        $stmt->close();
        header("Location: question-edit.php");
        return "An error occured. Try again.";
        exit(0);
    } else {
        $_SESSION['message'] = "Quiz Title Edited Successfully";
        $stmt->close();
        header("Location: question-edit.php");
        return "success";
        exit(0);
    }
}

function editOption($id, $text)
{
    $mysqli = connect();
    $stmt = $mysqli->prepare("UPDATE question_option SET text = ? WHERE id = ?");
    $stmt->bind_param("ss", $text, $id);
    $stmt->execute();
    if ($stmt->affected_rows != 1) {
        $_SESSION['message'] = "Connection error!";
        $stmt->close();
        return "An error occured. Try again.";
        exit(0);
    } else {
        $_SESSION['message'] = "Option Edited Successfully";
        $stmt->close();
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

function addOption($question_id, $text)
{
    $mysqli = connect();

    // Submitting option function
    $stmt = $mysqli->prepare("INSERT INTO question_option(question_id, text) VALUES(?,?)");
    $stmt->bind_param("ss", $question_id, $text);
    $stmt->execute();
    if ($stmt->affected_rows != 1) {
        $_SESSION['message'] = "Option Not Added!";
        $stmt->close();
        header("question-edit.php");
        return "An error occured. Try again.";
        exit(0);
    } else {
        $_SESSION['message'] = "Option Successfully Added!";
        $stmt->close();
        header("question-edit.php");
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

function updateTrueAns($question_id, $option_id)
{
    $mysqli = connect();

    // look for the data information
    $sql = "SELECT * FROM true_answer WHERE question_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $question_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data == NULL) {
        $stmt = $mysqli->prepare("INSERT INTO true_answer(question_id, option_id) VALUES(?,?)");
        $stmt->bind_param("ss", $question_id, $option_id);
        $stmt->execute();
        if ($stmt->affected_rows != 1) {
            $_SESSION['message'] = "Option answer Not saved!";
            $stmt->close();
            return "An error occured. Try again.";
            exit(0);
        } else {
            $_SESSION['message'] = "Option answer Successfully saved!";
            $stmt->close();
            return "success";
            exit(0);
        }
    } else {
        // Submitting option function
        $stmt = $mysqli->prepare("UPDATE true_answer SET option_id = ? WHERE question_id = ?");
        $stmt->bind_param("ss", $option_id, $question_id);
        $stmt->execute();
        if ($stmt->affected_rows != 1) {
            $_SESSION['message'] = "Option answer Not saved!";
            $stmt->close();
            return "An error occured. Try again.";
            exit(0);
        } else {
            $_SESSION['message'] = "Option answer Successfully saved!";
            $stmt->close();
            return "success";
            exit(0);
        }
    }
}
