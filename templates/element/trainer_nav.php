<style>
    /* Premium Trainer Sidebar */
    .trainer-sidebar {
        width: 280px;
        background: linear-gradient(160deg, #120a22 0%, #0d0d0f 100%);
        border-right: 1px solid rgba(255,255,255,0.06);
        padding: 40px 0;
        height: 100vh;
        position: sticky;
        top: 0;
        display: flex;
        flex-direction: column;
    }

    .ts-brand {
        padding: 0 30px;
        margin-bottom: 40px;
    }
    .ts-brand a {
        font-family: 'Outfit', sans-serif;
        font-size: 24px;
        font-weight: 800;
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .ts-brand a span { color: var(--primary); }

    .ts-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .ts-menu li {
        margin-bottom: 5px;
    }
    .ts-menu a {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 30px;
        color: #888;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }
    .ts-menu a i {
        font-size: 20px;
        transition: color 0.2s;
    }
    .ts-menu a:hover {
        background: rgba(255,255,255,0.03);
        color: white;
    }
    .ts-menu a.active {
        background: rgba(138,43,226,0.1);
        color: white;
        border-left-color: var(--primary);
    }
    .ts-menu a.active i {
        color: var(--primary);
    }

    .ts-user {
        margin-top: auto;
        padding: 20px 30px 0;
        border-top: 1px solid rgba(255,255,255,0.06);
    }
    .ts-user-card {
        display: flex;
        align-items: center;
        gap: 12px;
        color: white;
    }
    .ts-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
    }
    .ts-info .name { font-size: 14px; font-weight: 700; }
    .ts-info .role { font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 1px; }

</style>

<?php 
$currentAction = $this->request->getParam('action'); 
?>

<div class="trainer-sidebar">
    <div class="ts-brand">
        <a href="/">
            <i class="ph-fill ph-barbell" style="color: var(--primary);"></i>
            <div>Anytime<span>Fitness</span></div>
        </a>
    </div>

    <ul class="ts-menu">
        <li>
            <a href="<?= $this->Url->build('/trainer') ?>" class="<?= $currentAction === 'index' ? 'active' : '' ?>">
                <i class="ph ph-squares-four"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build('/trainer/classes') ?>" class="<?= in_array($currentAction, ['classes', 'addClass', 'editClass']) ? 'active' : '' ?>">
                <i class="ph ph-calendar-check"></i> Manage Classes
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build('/trainer/coaching') ?>" class="<?= $currentAction === 'coaching' ? 'active' : '' ?>">
                <i class="ph ph-user-focus"></i> Private Coaching
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build('/trainer/trainers') ?>" class="<?= in_array($currentAction, ['trainers', 'addTrainer', 'editTrainer']) ? 'active' : '' ?>">
                <i class="ph ph-chalkboard-teacher"></i> Manage Trainers
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build('/trainer/members') ?>" class="<?= in_array($currentAction, ['members', 'addMember', 'editMember']) ? 'active' : '' ?>">
                <i class="ph ph-users"></i> Manage Members
            </a>
        </li>
        <li style="margin-top: 20px;">
            <a href="<?= $this->Url->build('/') ?>">
                <i class="ph ph-house"></i> Return to Site
            </a>
        </li>
    </ul>

    <div class="ts-user">
        <div class="ts-user-card">
            <div class="ts-avatar">
                <?= strtoupper(substr($user->FullName ?? 'T', 0, 1)) ?>
            </div>
            <div class="ts-info">
                <div class="name"><?= h($user->FullName ?? 'Trainer') ?></div>
                <div class="role">Trainer Portal</div>
            </div>
        </div>
    </div>
</div>
