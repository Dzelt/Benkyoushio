<?php

session_start();

function logoutUser()
{
    session_destroy();
    header("location: index.php");
    exit();
}
