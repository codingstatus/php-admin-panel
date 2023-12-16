<?php
session_start();

if (isset($_SESSION['email'])) {
    session_unset();
    session_destroy();
}

header("Location: ../index.php");
exit;
?>
