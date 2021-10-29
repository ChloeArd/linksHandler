<?php

if (isset($_POST["email"], $_POST["subject"], $_POST['message'])) {

    $email = htmlentities(trim($_POST['email']));
    $subject = htmlentities(trim($_POST['subject']));
    $message = htmlentities(trim($_POST['message']));
    $message = wordwrap($message, 70, "\r\n");
    $headers = array(
        'Reply-To' => 'chloe.ardoise@gmail.com',
        'Cc' => 'chloe@chloeard.fr',
        'X-Mailer' => 'PHP/' . phpversion()
    );

    mail($email, $subject, $message, $headers, "-f chloe.ardoise@gmail.com");

    header("Location: ../../index.php?controller=home&page=contact&success=0");
}