<?php
/**
 * Global Navbar Element
 * Variables expected:
 * - $user (Auth.User session data)
 * - $activeMembership (Optional, membership status)
 * - $active (String indicating the active nav item: 'home', 'trainers', 'coaching', 'schedule')
 */
$active = $active ?? 'home';
$user = $user ?? $this->request->getSession()->read('Auth.User');
?>
<nav class="navbar" style="background: rgba(15, 15, 17, 0.95); position: sticky; z-index: 100;">
    <div class="nav-brand">
        <a href="<?= $this->Url->build('/') ?>" style="display: flex; align-items: center; gap: 10px;">
            <img src="<?= $this->Url->assetUrl('favicon.ico') ?>" alt="Logo" style="height: 32px; width: auto;">
            <div>Anytime<span style="color: var(--primary);">Fitness</span></div>
        </a>
    </div>
    <div class="nav-links">
        <a href="<?= $this->Url->build('/') ?>#pricing" <?= $active === 'home' ? 'style="color: var(--primary);"' : '' ?>>Membership Plans</a>
        <a href="<?= $this->Url->build('/our-trainers') ?>" <?= $active === 'trainers' ? 'style="color: var(--primary);"' : '' ?>>Our Trainers</a>
        <a href="<?= $this->Url->build('/private-coaching') ?>" <?= $active === 'coaching' ? 'style="color: var(--primary);"' : '' ?>>Private Coaching</a>
        <?php if ($active === 'home'): ?>
            <a href="#about">Why Join</a>
        <?php else: ?>
            <a href="<?= $this->Url->build('/') ?>#about">Why Join</a>
        <?php endif; ?>
        <?php if (!empty($user)): ?>
            <a href="<?= $this->Url->build('/schedule') ?>" <?= $active === 'schedule' ? 'style="color: var(--primary);"' : '' ?>>
                <i class="ph ph-calendar-check"></i> Class Schedule
            </a>
        <?php endif; ?>
    </div>
    
    <div style="display: flex; align-items: center; gap: 15px;">
        <?php if (!empty($user)): ?>
            <!-- Logged-in profile dropdown -->
            <div class="profile-dropdown">
                <div class="profile-avatar" onclick="toggleDropdown(event)">
                    <?= $this->Html->image('default_avatar.png', ['alt' => 'Profile']) ?>
                </div>
                <div class="dropdown-menu" id="profileDropdown">
                    <div class="dropdown-header">
                        <span class="user-name"><?= h($user->FullName ?? 'User') ?></span>
                        <span class="user-email"><?= h($user->Email ?? '') ?></span>
                        <?php if (isset($activeMembership) && strtolower($activeMembership->Status ?? '') === 'active'): ?>
                            <span class="status-badge status-booked" style="margin-top: 6px; font-size: 10px;">
                                <i class="ph-fill ph-check-circle"></i> <?= h($activeMembership->package->PackageName ?? 'Active Plan') ?>
                            </span>
                        <?php else: ?>
                            <span class="status-badge status-waitlist" style="margin-top: 6px; font-size: 10px;">No Active Plan</span>
                        <?php endif; ?>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="<?= $this->Url->build('/users/edit/' . ($user->UserID ?? '')) ?>"><i class="ph ph-user"></i> My Profile</a>
                    <?php if (strtolower($user->Role ?? '') === 'trainer'): ?>
                        <a href="<?= $this->Url->build('/trainer') ?>" style="color: #2ecc71;"><i class="ph ph-chalkboard-teacher"></i> Trainer Portal</a>
                    <?php endif; ?>
                    <a href="<?= $this->Url->build('/schedule') ?>"><i class="ph ph-calendar-check"></i> Class Schedule</a>
                    <a href="<?= $this->Url->build('/memberships/status') ?>"><i class="ph ph-identification-card"></i> Membership Status</a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= $this->Url->build('/users/logout') ?>" style="color: #e74c3c;"><i class="ph ph-sign-out"></i> Log Out</a>
                </div>
            </div>
        <?php else: ?>
            <button onclick="openLoginModal()" class="nav-cta" id="navLoginBtn" style="background: transparent; border: 1px solid rgba(255,255,255,0.2); color: white; cursor: pointer; font-family: inherit; font-size: inherit;">Login</button>
            <button onclick="openRegisterModal()" class="nav-cta" style="cursor: pointer; font-family: inherit; font-size: inherit; border: none;">Join Now</button>
        <?php endif; ?>
    </div>
</nav>

<?php if (empty($user)): ?>
    <?= $this->element('login_modal') ?>
<?php endif; ?>

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
