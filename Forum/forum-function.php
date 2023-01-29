<?php

function addPost($user_id, $username, $text)
{
    $mysqli = connect();

    // Submitting option function
    $stmt = $mysqli->prepare("INSERT INTO forum(user_id, username, text) VALUES(?,?,?)");
    $stmt->bind_param("sss", $user_id, $username, $text);
    $stmt->execute();
    if ($stmt->affected_rows != 1) {
        $_SESSION['message'] = "No post published!";
        $stmt->close();
        header("question-edit.php");
        return "An error occured. Try again.";
        exit(0);
    } else {
        $_SESSION['message'] = "Post Successfully Added!";
        $stmt->close();
        header("question-edit.php");
        return "success";
        exit(0);
    }
}
