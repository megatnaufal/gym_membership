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
                    <div class="profile-dropdown">
                        <div class="profile-avatar" onclick="toggleDropdown(event)">
                            <?= $this->Html->image('default_avatar.png', ['alt' => 'Admin Profile']) ?>
                        </div>
                        <div class="dropdown-menu" id="profileDropdown">
                            <div class="dropdown-header">
                                <span class="user-name">Admin User</span>
                                <span class="user-email">admin@anytime.com</span>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="<?= $this->Url->build('/users') ?>"><i class="ph ph-users"></i> Manage Users</a>
                            <a href="<?= $this->Url->build('/users/edit/' . ($authUser->UserID ?? '')) ?>"><i class="ph ph-gear"></i> Settings</a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= $this->Url->build('/users/logout') ?>" style="color: var(--danger);"><i class="ph ph-sign-out" style="color: var(--danger);"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </header>

            <div class="dashboard-content">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </main>
    </div>
    <script>
        function toggleDropdown(event) {
            event.stopPropagation();
            document.getElementById("profileDropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.profile-avatar') && !event.target.closest('.profile-avatar')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>
