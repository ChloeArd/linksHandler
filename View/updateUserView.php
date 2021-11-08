<main>
    <h1 class="center">Modifier mes informations</h1>
    <form method="post" action="" class="flexColumn flexCenter width80 auto">
        <label for="firstname">Prénom</label>
        <input type="text" id="firstname" name="firstname" value="<?=$_SESSION['firstname']?>" required>
        <label for="lastname">Nom de famille</label>
        <input type="text" id="lastname" name="lastname" value="<?=$_SESSION['lastname']?>" required>
        <label for="email">Mail</label>
        <input type="email" id="email" name="email" value="<?=$_SESSION['email']?>" required>
        <input type="hidden" id="id" name="id" value="<?=$_SESSION['id']?>">
        <input id="updateUser" type="submit" name="submit" value="Modifier" class="button">
    </form>
</main>
