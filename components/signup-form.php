<?php
    /**
     * @param APP_NAME
     */
?>

<form class="card p-4" method="POST">
    <center class="pt-2"><a class="text-decoration-none text-reset" style="font-size: 1.75em" href="/"><?= $APP_NAME ?></a></center>

    <hr />

    <label for="name" class="pb-2">Name</label>
    <input name="name" type="text" id="name" class="form-control" required="true" autofocus="">

    <label for="address" class="pt-3 pb-2">Address</label>
    <input name="address" type="text" id="address" class="form-control" required="true" autofocus="">

    <label for="email" class="pt-3 pb-2">Email address</label>
    <input name="email" type="email" id="email" class="form-control" required="true" autofocus="">

    <label for="password" class="pt-3 pb-2">Password</label>
    <input name="password" type="password" id="password" class="form-control" required="true">
    
    <hr />

    <input type="reset" class="btn mb-2 btn-warning" value="Reset"/>

    <button class="btn btn-success">Signup</button>
</form>