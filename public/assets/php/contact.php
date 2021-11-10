<?php

if (isset($_POST["email"], $_POST["subject"], $_POST['message'])) {

    $email = htmlentities(trim($_POST['email']));
    $to = "chloe@chloeard.fr";
    $subject = htmlentities(trim($_POST['subject']));
    $message = htmlentities(trim($_POST['message']));
    $message = wordwrap($message, 70, "\r\n");
    $headers = array(
        'Reply-To' => $email,
        'Cc' => 'chloe@chloeard.fr',
        'X-Mailer' => 'PHP/' . phpversion()
    );
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        mail($to, $subject, $message, $headers, "-f " . $email);
        header("Location: ../../index.php?controller=home&page=contact&success=0&message=Envoyer%20avec%20succés");
    }
    else {
        header("Location: ../../index.php?controller=home&page=contact&error=0&message=L'email%20n'est%20pas%20valide.");
    }
}
else {
    header("Location: ../../index.php?controller=home&page=contact&error=1&message=Tous%20les%20champs%20ne%20sont%20pas%20complétés.");
}