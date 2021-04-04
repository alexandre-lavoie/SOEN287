<?php
    /**
     * @param FOOTER
     */
?>

<footer class="bg-dark text-white py-5">
    <div class="container">
        <p><?= $FOOTER ?></p>
        <?php if(is_admin()) { ?>
            <p><a href="/backstore">Admin</a></p>
        <?php } ?>
    </div>
</footer>