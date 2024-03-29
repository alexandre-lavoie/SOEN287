<?php
    /**
     * @param PAGE_TITLE
     */
?>

<div class="card">
    <div class="nav flex-column">
        <div class="nav-item">
            <a class="nav-link <?= strpos($PAGE_TITLE, 'Backstore') === 0  ? 'active' : '' ?>" href="/backstore"><i class="bi bi-house-door"></i> Dashboard</a> 
        </div>
        <div class="nav-item">
            <a class="nav-link <?= strpos($PAGE_TITLE, 'Account') === 0  ? 'active' : '' ?>" href="/backstore/accounts"><i class="bi bi-people"></i> Accounts</a> 
        </div>
        <div class="nav-item">
            <a class="nav-link <?= strpos($PAGE_TITLE, 'Aisle') === 0  ? 'active' : '' ?>" href="/backstore/aisles"><i class="bi bi-shop-window"></i> Aisles</a> 
        </div>
        <div class="nav-item">
            <a class="nav-link <?= strpos($PAGE_TITLE, 'Product') === 0  ? 'active' : '' ?>" href="/backstore/products"><i class="bi bi-cart"></i> Products</a> 
        </div>
        <div class="nav-item">
            <a class="nav-link <?= strpos($PAGE_TITLE, 'Splash') === 0  ? 'active' : '' ?>" href="/backstore/splashs"><i class="bi bi-card-image"></i> Splashs</a> 
        </div>
        <div class="nav-item">
            <a class="nav-link <?= strpos($PAGE_TITLE, 'Order') === 0  ? 'active' : '' ?>" href="/backstore/orders"><i class="bi bi-receipt"></i> Orders</a> 
        </div>
        <div class="nav-item">
            <a class="nav-link <?= strpos($PAGE_TITLE, 'Download') === 0  ? 'active' : '' ?>" href="/backstore/download"><i class="bi bi-download"></i> Download</a> 
        </div>
        <div class="nav-item">
            <a class="nav-link <?= strpos($PAGE_TITLE, 'Upload') === 0  ? 'active' : '' ?>" href="/backstore/upload"><i class="bi bi-upload"></i> Upload</a> 
        </div>
    </div>
</div>