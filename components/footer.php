<?php
    /**
     * 
     */
?>

<footer class="bg-dark text-white py-5">
    <div class="container">
        <p>WEO is a SOEN287 project created by Alexandre Lavoie.</p>
        <?php if(is_admin()) { ?>
            <p><a href="/backstore">Admin</a></p>
        <?php } ?>
    </div>
</footer>