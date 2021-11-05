<main class="flexRow flexCenter wrap">
    <div id="homeLinks" class="width100 flexRow wrap flexCenter"></div>

    <?php
    if ($_SESSION['id']) {
        ?>
        <script>
            //say that a user is logged in
            sessionStorage.session = "ok";
            sessionStorage.role = <?=$_SESSION['role_fk']?>
        </script>
    <?php
    }
    ?>
</main>
