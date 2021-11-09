<main>
    <h1 class="center">Inscription</h1>
    <form method="post" action="../../assets/php/registration.php" class="flexColumn flexCenter width80 auto">
        <label for="firstname">Prénom</label>
        <input type="text" id="firstname" name="firstname" required>
        <label for="lastname">Nom de famille</label>
        <input type="text" id="lastname" name="lastname" required>
        <label for="mail">Mail</label>
        <input type="email" id="mail" name="email" required>
        <label for="pass">Mot de passe</label>
        <input type="password" id="pass" name="password" required>
        <label for="passR">Répet du mot de passe</label>
        <input type="password" id="passR" name="passwordR" required>
        <input type="submit" name="submit" value="M'inscrire" class="button">
    </form>
</main>