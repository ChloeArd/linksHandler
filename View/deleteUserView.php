<main>
    <h1 class="center">Supprimer mon compte</span></h1>
    <form method="post" action="" class="flexColumn flexCenter auto width80">
        <p class="center margTop40">Voulez vous vraiment supprimer votre compte ?</p>
        <input type="hidden" value="<?=$_SESSION['id']?>" id="id" name="id">
        <input id="deleteUser" type="submit" name="submit" value="Oui" class="button margTop15">
        <a href="../../" class="button button2">Non</a>
    </form>
</main>