<?php
$cakeDescription = 'Anytime Admin';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['anytime_admin']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <i class="ph ph-barbell"></i>
                <div>Anytime<span>Admin</span></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-label">Main</div>
                <a href="<?= $this->Url->build('/admin') ?>"><i class="ph ph-squares-four"></i> Dashboard</a>
                
                <div class="menu-label" style="margin-top: 20px;">Management</div>
                <a href="<?= $this->Url->build('/users') ?>"><i class="ph ph-users"></i> Users</a>
                <a href="<?= $this->Url->build('/memberships') ?>"><i class="ph ph-identification-card"></i> Memberships</a>
                <a href="<?= $this->Url->build('/classes') ?>"><i class="ph ph-calendar-check"></i> Classes</a>
                <a href="<?= $this->Url->build('/bookings') ?>"><i class="ph ph-address-book"></i> Bookings</a>
                <a href="<?= $this->Url->build('/trainers') ?>"><i class="ph ph-chalkboard-teacher"></i> Trainers</a>
                
                <div class="menu-label" style="margin-top: 20px;">Shop / Store</div>
                <a href="<?= $this->Url->build('/products') ?>"><i class="ph ph-shopping-bag"></i> Products</a>
                <a href="<?= $this->Url->build('/orders') ?>"><i class="ph ph-receipt"></i> Orders</a>
                <a href="<?= $this->Url->build('/order-items') ?>"><i class="ph ph-list-numbers"></i> Order Items</a>
                
                <div class="menu-label" style="margin-top: 20px;">System</div>
                <a href="<?= $this->Url->build('/packages') ?>"><i class="ph ph-package"></i> Packages</a>
            </div>
            
            <div class="sidebar-footer">
                <a href="<?= $this->Url->build('/') ?>"><i class="ph ph-sign-out"></i> Return to Main Site</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="top-bar">
                <div>
                    <span style="color: var(--text-muted);">Admin / </span> <?= $this->fetch('title') ?>
                </div>
                <div class="user-profile">
                    <span style="font-size: 14px; color: #ccc;">Admin User</span>
                    <div class="avatar">A</div>
                </div>
            </header>

            <div class="dashboard-content">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </main>
    </div>
</body>
</html>
