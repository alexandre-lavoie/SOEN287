<?php requires_admin() ?>

<?php
    include(dirname(__FILE__) . "/../../db/upload.php");

    if(isset($_FILES['xml'])) {
        Upload::xml();
    }
?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
    </head>
    <body class="bg-light">
        <?php include("../components/admin-header.php") ?>

        <div class="p-2">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-2 pb-2">
                    <?php include(dirname(__FILE__) . "/../../components/admin-nav.php") ?>
                </div>
                <div class="col-12 col-md-8 col-lg-10 pb-2">
                    <div class="card p-2">
                        <h2>Upload</h2>

                        <hr/>

                        <h5>Website XML</h5>

                        <br/>

                        <form method="POST" enctype="multipart/form-data">
                            <input type="file" name="xml" id="xml">
                            <br/><br/>
                            <input type="submit" class="btn btn-success"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>