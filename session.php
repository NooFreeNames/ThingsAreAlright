<?php

if (!isset($_SESSION['user'])) {
    header('Location: guest.php');
    exit();
}

$user = $_SESSION['user'];
$user_id = (int)$_SESSION['user']['id'];
