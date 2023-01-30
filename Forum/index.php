<?php

if (!isset($_SESSION["user"])) {
    header("location: main-forum.php");
    exit();
}
