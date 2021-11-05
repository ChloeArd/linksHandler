<main class="flexRow flexCenter wrap">
    <div id="homeLinks" class="width100 flexRow wrap flexCenter"></div>

    <?php
    if ($_SESSION['id']) {
        ?>
        <script>
            sessionStorage.session = "ok";
        </script>
    <?php
    }
    ?>
</main>
