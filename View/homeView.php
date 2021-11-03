<main class="flexRow flexCenter wrap">
    <?php
    // Integration of the thumbalizr function to be able to integrate thumbnails directly on my website
    function thumbalizr($url, $options = array()) {
        $embed_key = "zFxVAff4lQewBOVFMDT7T2VYBXR";
        $secret = 'K6YFjElYCQ6SGvuVztslN2GDx7Z';

        $query = 'url=' . urlencode($url);

        foreach($options as $key => $value) {
            $query .= '&' . trim($key) . '=' . urlencode(trim($value));

        }
        $token = md5($query . $secret);

        return "https://api.thumbalizr.com/api/v1/embed/$embed_key/$token/?$query";
    }

    if (isset($var['links'])) {
        foreach ($var['links'] as $link) {?>
                <form id="linkContainer" action="" method="post">
                    <input type="hidden" name="id" value="<?=$link->getId()?>">
                    <input type="hidden" name="href" value="<?=$link->getHref()?>">
                    <input type="hidden" name="target" value="<?=$link->getTarget()?>">
                    <input type="hidden" name="click" value="<?=$link->getClick()?>">
                    <div class="flexColumn width100">
                        <div id="containerPicture">
                            <img src="<?php echo thumbalizr($link->getHref()); ?>" title="<?=$link->getTitle()?>">
                        </div>
                        <div id="containerLink" class="flexCenter">
                            <input class="buttonLink" type="submit" name="send" value="<?=$link->getName()?>">
                        </div>
                    </div>
                </form>
            <?php
            if (isset($_SESSION['id'])) {
                if ($_SESSION['role_fk'] != 2) {?>
                    <div class="flexColumn edit">
                        <a href="../index.php?controller=link&action=update&id=<?=$link->getId()?>"><i class="fas fa-pen-square"></i></a>
                        <a href="../index.php?controller=link&action=delete&id=<?=$link->getId()?>"><i class="fas fa-trash-alt"></i></a>
                    </div>
                    <?php
                }
            }
        }
    }
    ?>
</main>
