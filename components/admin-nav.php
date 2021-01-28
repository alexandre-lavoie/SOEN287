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
            <a class="nav-link <?= strpos($PAGE_TITLE, 'Product') === 0  ? 'active' : '' ?>" href="/backstore/products"><i class="bi bi-cart"></i> Products</a> 
        </div>
        <div class="nav-item">
            <a class="nav-link <?= strpos($PAGE_TITLE, 'Account') === 0  ? 'active' : '' ?>" href="/backstore/accounts"><i class="bi bi-people"></i> Accounts</a> 
        </div>
        <div class="nav-item">
            <a class="nav-link <?= strpos($PAGE_TITLE, 'Order') === 0  ? 'active' : '' ?>" href="/backstore/orders"><i class="bi bi-receipt"></i> Orders</a> 
        </div>
    </div>
</div>