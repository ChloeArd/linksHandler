<main class="flexRow flexCenter wrap">
    <div id="homeLinks" class="width100 flexRow wrap flexCenter"></div>

    <?php
    if (isset($_SESSION['id'])) {
        ?>
        <script>
            sessionStorage.session = "open";
            //say that a user is logged in
            if (sessionStorage.session !== "close") {
                sessionStorage.role = <?=$_SESSION['role_fk']?>
            }
        </script>
    <?php
    }
    ?>
</main>
