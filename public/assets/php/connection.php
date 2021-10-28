<?php
use Chloe\LinksHandler\Model\DB;

require "../../../src/Model/DB.php";

if (isset($_POST["email"], $_POST["password"])) {
    $bdd = DB::getInstance();

    $mail = htmlentities(trim($_POST['email']));
    $pass = htmlentities(trim($_POST['password']));

    // I get the name of the user
    $stmt = $bdd->prepare("SELECT * FROM prefix_user WHERE email = :email");
    $stmt->bindParam(":email", $mail);
    $stmt->execute();

    $user = $stmt->fetch();
    if (password_verify($pass, $user['password'])) {
        // If the 2 password correspond then we open the session and we store the user's data in a session.
        session_start();

        $timeSession = 60 * 60 * 5; // session ends after 5 hours
        session_set_cookie_params($timeSession);

        $_SESSION['id'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['email'] = $mail;
        $_SESSION['password'] = $pass;
        $_SESSION['role_fk'] = $user['role_fk'];
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