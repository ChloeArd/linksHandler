<main class="flexColumn flexCenter wrap">
    <h1>Mes statistiques</h1>

    <div class="flexRow width80">
        <div class="flexColumn width20">
            <a href="../../index.php?controller=user&action=account" class="border center">Mes informations</a>
            <a href="../../index.php?controller=user&action=statistic" class="border center">Mes statistiques</a>
        </div>

        <div class="border width80 margB">
            <h2>Le nombre de lien présents dans le système</h2>
            <?php

            use Chloe\LinksHandler\Model\DB;

            if (isset($var['stat1'])) {?>
                <p class="info2"><?=count($var['stat1'])?></p>
                <h2>Le nombre total cumulé de clics sur les liens</h2>
            <?php
            $nbClick = [];
                foreach ($var['stat1'] as $stat2) {
                    array_push($nbClick, $stat2->getClick());
                }
                ?>
                <p class="info2"><?=array_sum($nbClick)?></p>
                <?php
            }
            ?>

            <h2>Le nombre de fois où un lien a été visité</h2>
            <canvas id="myChart"></canvas>
            <script src="../assets/js/app.js" type="module"></script>
            <h2>Le nombre de lien en commun avec les autres utilisateurs</h2>
        </div>
    </div>


</main>