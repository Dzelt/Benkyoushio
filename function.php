<?php

require "config.php";

function connect()
{
    $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($mysqli->connect_errno != 0) {
        $error = $mysqli->connect_error;
        $error_date = date("F j, Y, g:i a");
        $message = "{$error} | {$error_date} \r\n";
        file_put_contents("db-log.txt", $message, FILE_APPEND);
        return false;
    } else {
        return $mysqli;
    }
}

function registerUser($user_type, $email, $username, $password, $confirm_password)
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

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Email is not valid";
    }
    // check existing email (avoid duplicate email)
    $stmt = $mysqli->prepare("SELECT email FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data != NULL) {
        return "Email already bounded to an account.";
    }

    if (strlen($username) > 50) {
        return "Username accept only 50 characters.";
    }

    // check existing username (avoid duplicate username)
    $stmt = $mysqli->prepare("SELECT username FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data != NULL) {
        return "Username already bounded to an account.";
    }

    if (strlen($password) > 50) {
        return "Password accept only 50 characters.";
    }

    if ($password != $confirm_password) {
        return "Password not match.";
    }
    // hashing the password before save at the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Submitting user data function
    $stmt = $mysqli->prepare("INSERT INTO user(user_type, username, password, email) VALUES(?,?,?,?)");
    $stmt->bind_param("ssss", $user_type, $username, $hashed_password, $email);
    $stmt->execute();
    if ($stmt->affected_rows != 1) {

        return "An error occured. Try again.";
    } else {
        return "success";
    }
}

function loginUser($email, $password)
{
    $mysqli = connect();
    $email = trim($email);
    $password = trim($password);

    if ($email == "" || $password == "") {
        return "Both field are required!";
    }

    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    // look for the account information
    $sql = "SELECT id, email, password, user_type, username FROM user WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data == NULL) {
        $stmt->close();
        return "Wrong Email or Password";
    }

    if (password_verify($password, $data["password"]) == FALSE) {
        $stmt->close();
        return "Wrong Email or Password";
    } else {
        $_SESSION["user"] = $data['username'];
        $_SESSION["user_type"] = $data['user_type'];
        $_SESSION["user_id"] = $data['id'];
        $stmt->close();
        if ($_SESSION["user_type"] == 1) {
            header("location: admin-dashboard.php");
            exit();
        } else {
            header("location: dashboard.php");
            exit();
        }
    }
}

function logoutUser()
{
    session_destroy();
    header("location: index.php");
    exit();
}

function resetPassword()
{
}

function deleteAcc()
{
}
