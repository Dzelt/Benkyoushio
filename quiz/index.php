<?php

if (!isset($_SESSION["user"])) {
    header("location: quiz-dashboard.php");
    exit();
}
