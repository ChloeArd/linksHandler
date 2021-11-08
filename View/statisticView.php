<main class="flexColumn flexCenter wrap">
    <h1>Mes statistiques</h1>

    <div id="containerAccount" class="flexRow width90">
        <div class="flexColumn width20">
            <a href="../../index.php?controller=user&action=account" class="border center">Mes informations</a>
            <?php
            if ($_SESSION['role_fk'] == 1) {?>
                <a href="../../index.php?controller=user&action=statistic" class="border center">Mes statistiques</a>
                <?php
            }
            ?>
            <a href="../assets/php/disconnection.php" id="disconnection" class="border center">Déconnexion</a>
        </div>

        <div class="border width80 margB">
            <h2>Le nombre de lien présents dans le système</h2>
            <?php

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

                <h2>Le nombre de fois où un lien a été visité</h2>
                <canvas id="myChart"></canvas>
                <script src="../assets/js/graph1.js" type="module"></script>

                <?php
                $name = [];
                $click = [];

                foreach ($var['stat1'] as $stat2) {
                    array_push($name, $stat2->getName());
                    array_push($click, $stat2->getClick());
                }

                $name2 = "";
                $click2 = "";
                $count = count($name);
                for($i = 0; $i < $count; $i++ ) {
                    if ($i < ($count - 1)) {
                        $name2 .= $name[$i] . ", ";
                        $click2 .= $click[$i] . ", ";
                    }
                    else {
                        $name2 .= $name[$i];
                        $click2 .= $click[$i];
                    }
                }
                ?>
                <form method="post" action="" class="width100 borderNone flexCenter">
                    <input id="name" type="hidden" name="name" value="<?=$name2?>">
                    <input id="click" type="hidden" name="click" value="<?=$click2?>">
                    <input id="graph1" type="submit" name="send" class="button" value="Actualiser le graphique">
                </form>
            <?php
            }
            ?>

            <h2>Le nombre de lien en commun avec les autres utilisateurs</h2>
            <?php

            $link = [];

            foreach ($var['stat1'] as $stat2) {
                array_push($link, $stat2->getHref());
            }

            $tmp = array_count_values($link);
            ?>
            <div class="graph">
                <canvas id="myPie"></canvas>

            </div>
            <script src="../assets/js/graph2.js" type="module"></script>

            <?php
            $linkHref = [];
            $duplicate = [];

            foreach ($tmp as $key => $value) {
                if ($value >= 2) {
                    array_push($linkHref, $key);
                    array_push($duplicate, $value);
                }
            }

            $linkHref2 = "";
            $duplicate2 = "";
            $count = count($linkHref);
            for($i = 0; $i < $count; $i++ ) {
                if ($i < ($count - 1)) {
                    $linkHref2 .= $linkHref[$i] . ", ";
                    $duplicate2 .= $duplicate[$i] . ", ";
                }
                else {
                    $linkHref2 .= $linkHref[$i];
                    $duplicate2 .= $duplicate[$i];
                }
            }
            ?>

            <form method="post" action="" class="width100 borderNone flexCenter">
                <input id="link" type="hidden" name="link" value="<?=$linkHref2?>">
                <input id="duplicate" type="hidden" name="duplicate" value="<?=$duplicate2?>">
                <input id="graph2" type="submit" name="send" class="button" value="Actualiser le graphique">
            </form>
        </div>
    </div>
</main>