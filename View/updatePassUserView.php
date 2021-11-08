<main>
    <h1 class="center">Changer mon mot de passe</h1>
    <form method="post" action="" class="flexColumn flexCenter width80 auto">
        <label for="passN">Mot de passe actuel</label>
        <input type="password" id="passN" name="passN" required>
        <label for="pass">Nouveau mot de passe</label>
        <input type="password" id="pass" name="pass" required>
        <label for="passR">Répet du nouveau mot de passe</label>
        <input type="password" id="passR" name="passR" required>
        <input type="hidden" id="id" name="id" value="<?=$_SESSION['id']?>">
        <input id="updatePassUser" type="submit" name="submit" value="Modifier" class="button">
    </form>
</main>
