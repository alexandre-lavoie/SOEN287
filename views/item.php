<?php
    include_once("../db/aisle.php");
    include_once("../db/item.php");

    $aisle = current(AisleData::find([$_GET["aisle"]]));
    $item = current(ItemData::find([$_GET["id"]]));
    $nav = [
        ['url' => '/', 'name' => 'Home'], 
        ['url' => "/aisle?id=$aisle->id", 'name' => $aisle->name],
        ['url' => "/item?id=$item->id&aisle=$aisle->id", 'name' => $item->name]
    ];
?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
    </head>
    <body class="bg-light">
        <?php include("../components/header.php") ?>

        <nav class="bg-dark pt-3 pb-1">
            <ol class="d-flex justify-content-center breadcrumb">
                <li class="text-white breadcrumb-item"><a href="/">Home</a></li>
                <li class="text-white breadcrumb-item"><a href="/aisle?id=<?= $aisle->id ?>"><?= $aisle->name ?></a></li>
                <li class="text-white breadcrumb-item active"><?= $item->name ?></li>
            </ol>
        </nav>

        <section class="p-2" style="min-height: 78vh">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4 pb-2">
                        <div class="card d-flex justify-content-center">
                            <img style="object-fit: cover;" src="<?= $item->image ?>"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 pb-2">
                        <form method="POST" action="<?= is_account() ? "/cart" : "/login" ?>" class="card p-3">
                            <input name="item" type="hidden" value="<?= $item->id ?>"/>
                            <input name="aisle" type="hidden" value="<?= $aisle->id ?>"/>
                            <h4><?= $item->name ?></h4>
                            <h4 class="text-success">$<?= $item->price ?></h4>
                            <p><?= $item->description ?></p>
                            <?php
                                $selector_id = "quantity"; 
                                $quantity = 1;

                                include("../components/quantity-selector.php")
                            ?>
                            <br />
                            <button type="button" class="btn btn-dark mb-2">More Description</button>
                            <input type="submit" value="<?= is_account() ? "Add" : "Login" ?>" class="btn btn-success"></input>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php include("../components/footer.php") ?>
    </body>
</html>