<?php
    /**
     * 
     */
?>

<?php
    $message = 0;

    if($_GET["success"] == 1) {
        $message = 1;
    }
?>

<?php attempt_login() ?>

<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $message = 2;
    }
?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
    </head>
    <body class="bg-light">
        <?php include("../components/header.php") ?>

        <div class="d-flex justify-content-center align-items-center container" style="height: 90vh;">
            <div class="row">
                <div class="col">
                    <?php if($message == 1) { ?>
                        <div class="alert alert-success" role="alert">
                            Signup successful.
                        </div>
                    <?php } ?>

                    <?php if($message == 2) { ?>
                        <div class="alert alert-danger" role="alert">
                            Login failed.
                        </div>
                    <?php } ?>

                    <form class="card p-4" method="POST">
                        <center class="pt-2"><h4>We Eat Online</h4></center>

                        <hr />

                        <label for="email" class="pb-2">Email address</label>
                        <input name="email" type="email" id="email" class="form-control" required="" autofocus="">

                        <label for="password" class="pt-3 pb-2">Password</label>
                        <input name="password" type="password" id="password" class="form-control" required="">
                        <a class="pt-2" style="text-align: end; font-size: 14px" href="/forgot-password">Forgot Password?</a>

                        <hr />

                        <button class="btn btn-success">Login</button>

                        <center style="font-size: 14px" class="pt-3">
                            No account? <a class="pb-2" href="/signup">Signup</a>
                        </center>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>