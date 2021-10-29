<?php
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

if (isset($_POST["email"], $_POST["subject"], $_POST['message'])) {

    $email = htmlentities(trim($_POST['email']));
    $subject = htmlentities(trim($_POST['subject']));
    $message = htmlentities(trim($_POST['message']));

    $transport = Transport::fromDsn('smtp://localhost');
    $mailer = new Mailer($transport);

    $email = (new Email())
        ->from($email)
        ->to('chloe@chloeard.fr')
        ->replyTo('chloe.ardoise@gmail.com')
        ->subject($subject)
        ->text($message);

    $mailer->send($email);

    header("Location: ../../index.php?controller=home&action=contact&success=0");
}