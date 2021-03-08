<?php
    /**
     * @param nav
     */
?>

<nav class="bg-dark pt-3 pb-1">
    <ol class="d-flex justify-content-center breadcrumb">
        <?php
            $last = sizeof($nav);
            $i = 0;

            foreach($nav as $path) {
                if(++$i == $last) {?>
                    <li class="text-white breadcrumb-item active"><?= $path['name'] ?></li>
                <?php } else { ?>
                    <li class="text-white breadcrumb-item"><a href="<?= $path['url'] ?>"><?= $path['name'] ?></a></li>
                <?php }
            }
        ?>
    </ol>
</nav>

