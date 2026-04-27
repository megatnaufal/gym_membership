<?php
$this->assign('title', 'Dashboard');
?>
<div class="page-header">
    <h1>Welcome Back, Admin</h1>
    <p>Here's what's happening with your gym today.</p>
</div>

<!-- Metrics -->
<div class="metrics-grid">
    <div class="metric-card">
        <div class="metric-icon users">
            <i class="ph ph-users"></i>
        </div>
        <div class="metric-info">
            <h3>1,248</h3>
            <p>Total Users</p>
        </div>
    </div>
    
    <div class="metric-card">
        <div class="metric-icon members">
            <i class="ph ph-identification-card"></i>
        </div>
        <div class="metric-info">
            <h3>982</h3>
            <p>Active Memberships</p>
        </div>
    </div>
    
    <div class="metric-card">
        <div class="metric-icon sales">
            <i class="ph ph-currency-dollar"></i>
        </div>
        <div class="metric-info">
            <h3>$12,450</h3>
            <p>Shop Sales (MTD)</p>
        </div>
    </div>
    
    <div class="metric-card">
        <div class="metric-icon classes">
            <i class="ph ph-calendar-check"></i>
        </div>
        <div class="metric-info">
            <h3>24</h3>
            <p>Classes Today</p>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h2>Quick Actions</h2>
    <div class="action-grid">
        <a href="<?= $this->Url->build('/users/add') ?>" class="action-btn">
            <i class="ph ph-user-plus"></i>
            New User
        </a>
        <a href="<?= $this->Url->build('/products/add') ?>" class="action-btn">
            <i class="ph ph-package"></i>
            Add Product
        </a>
        <a href="<?= $this->Url->build('/classes/add') ?>" class="action-btn">
            <i class="ph ph-calendar-plus"></i>
            Schedule Class
        </a>
        <a href="<?= $this->Url->build('/memberships/add') ?>" class="action-btn">
            <i class="ph ph-id-mark"></i>
            New Membership
        </a>
    </div>
</div>
