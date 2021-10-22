<?php
use Chloe\LinksHandler\Model\DB;

require "../../src/Model/DB.php";

if (isset($_POST["mail"], $_POST["pass"])) {
    $bdd = DB::getInstance();

    $mail = htmlentities(trim($_POST['mail']));
    $pass = htmlentities(trim($_POST['pass']));

    // I get the name of the user
    $stmt = $bdd->prepare("SELECT * FROM prefix_user WHERE mail = :mail");
    $stmt->bindParam(":mail", $mail);
    $stmt->execute();

    $user = $stmt->fetch();
    if ($pass === $user['pass']) {
        // If the 2 password correspond then we open the session and we store the user's data in a session.
        session_start();

        $timeSession = 60 * 60 * 5; // session ends after 5 hours
        session_set_cookie_params($timeSession);

        $_SESSION['id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['mail'] = $mail;
        $_SESSION['pass'] = $pass;
        $id = $_SESSION['id'];

        header("Location: ../../index.php?success=0&id=$id");
    }
    else {
        header("Location: ../../index.php?controller=home&page=connection&error=0");
    }
}
else {
    header("Location: ../../index.php?controller=home&page=connection&error=1");
}