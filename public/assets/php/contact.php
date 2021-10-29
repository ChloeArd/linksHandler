<?php

if (isset($_POST["email"], $_POST["subject"], $_POST['message'])) {

    $email = htmlentities(trim($_POST['email']));
    $subject = htmlentities(trim($_POST['subject']));
    $message = htmlentities(trim($_POST['message']));

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        mail($email, $subject, $message);
        header("Location: ../../index.php?controller=home&page=contact&success=0");
    }
    else {
        header("Location: ../../index.php?controller=home&page=contact&error=0");
    }
}