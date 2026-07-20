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
            <h3><?= h($totalUsers) ?></h3>
            <p>Total Users</p>
        </div>
    </div>
    
    <div class="metric-card">
        <div class="metric-icon members">
            <i class="ph ph-identification-card"></i>
        </div>
        <div class="metric-info">
            <h3><?= h($activeMemberships) ?></h3>
            <p>Active Memberships</p>
        </div>
    </div>
    
    <div class="metric-card">
        <div class="metric-icon classes">
            <i class="ph ph-calendar-check"></i>
        </div>
        <div class="metric-info">
            <h3><?= h($classesToday) ?></h3>
            <p>Classes Today</p>
        </div>
    </div>

    <div class="metric-card">
        <div class="metric-icon trainers" style="background: rgba(155, 89, 182, 0.2); color: #9b59b6;">
            <i class="ph ph-chalkboard-teacher"></i>
        </div>
        <div class="metric-info">
            <h3><?= h($totalTrainers) ?></h3>
            <p>Trainers</p>
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
