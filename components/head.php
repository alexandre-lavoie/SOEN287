<?php
    /**
     * @param PAGE_TITLE
     */
?>

<title><?= $PAGE_TITLE ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<style>
    body {
        width: 100%;
        overflow-x: hidden;
    }

    a {
        color: #198754;
    }

    a:hover {
        color: #157347;
    }

    .table th {
        text-align: center;   
    }

    .table td {
        vertical-align: middle;
        text-align: center;   
    }

    .nav-link {
        color: black;
    }

    .nav-link.active {
        color: #198754;
    }
</style>

<?php 
    include_once("js.php")
?>