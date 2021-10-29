<?php

if (isset($_POST["email"], $_POST["subject"], $_POST['message'])) {

    $email = htmlentities(trim($_POST['email']));
    $subject = htmlentities(trim($_POST['subject']));
    $message = htmlentities(trim($_POST['message']));
    $message = wordwrap($message, 70, "\r\n");
    $headers = array(
        'Reply-To' => 'chloe@chloeard.fr',
        'Cc' => 'chloe.ardoise@gmail.com',
        'X-Mailer' => 'PHP/' . phpversion()
    );

    mail($email, $subject, $message, $headers, "-f chloe@chloeard.fr");

    header("Location: ../../index.php?controller=home&action=contact&success=0");
}