<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Class Schedule - Anytime Fitness</title>
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        .schedule-container {
            max-width: 1000px;
            margin: 60px auto;
            padding: 0 20px;
        }
        .class-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(10px);
        }
        .class-info h3 { margin: 0 0 5px 0; color: white; }
        .class-details { color: #aaa; font-size: 14px; display: flex; gap: 20px; margin-top: 10px; }
        .class-details div { display: flex; align-items: center; gap: 5px; }
        .class-details i { color: var(--primary); }
        
        .capacity-bar {
            width: 150px;
            height: 6px;
            background: rgba(255,255,255,0.1);
            border-radius: 3px;
            margin-top: 10px;
            overflow: hidden;
        }
        .capacity-fill {
            height: 100%;
            background: var(--primary);
        }
        .capacity-fill.full { background: #e74c3c; }
        
        .btn-book {
            padding: 12px 24px;
            background: var(--primary);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-book:hover { background: #5c35b1; color: white; }
        .btn-waitlist {
            background: transparent;
            border: 2px solid #e74c3c;
            color: #e74c3c;
        }
        .btn-waitlist:hover { background: rgba(231, 76, 60, 0.1); color: #e74c3c; }
    </style>
</head>
<body style="background: var(--bg-dark); color: white;">

    <nav class="navbar" style="background: rgba(15, 15, 17, 0.95); position: sticky; z-index: 100;">
        <div class="nav-brand"><a href="/">Anytime<span>Fitness</span></a></div>
        <div class="nav-links">
            <a href="<?= $this->Url->build('/schedule') ?>" style="color: var(--primary);">Class Schedule</a>
            <a href="<?= $this->Url->build('/private-coaching') ?>">Private Coaching</a>
        </div>
        <div style="display: flex; align-items: center; gap: 15px;">
            <?php if ($user): ?>
                <!-- Profile Dropdown -->
                <div class="profile-dropdown">
                    <div class="profile-avatar" onclick="toggleDropdown(event)">
                        <?= $this->Html->image('default_avatar.png', ['alt' => 'Profile']) ?>
                    </div>
                    <div class="dropdown-menu" id="profileDropdown">
                        <div class="dropdown-header">
                            <span class="user-name"><?= h($user->FullName ?? 'User') ?></span>
                            <span class="user-email"><?= h($user->Email ?? '') ?></span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="<?= $this->Url->build('/users/edit/' . ($user->UserID ?? '')) ?>"><i class="ph ph-user"></i> My Profile</a>
                        <a href="<?= $this->Url->build('/users/change-password') ?>"><i class="ph ph-lock-key"></i> Change Password</a>
                        <a href="<?= $this->Url->build('/schedule') ?>"><i class="ph ph-calendar-check"></i> Class Schedule</a>
                        <a href="<?= $this->Url->build('/memberships/status') ?>"><i class="ph ph-identification-card"></i> Membership Status</a>
                        <a href="<?= $this->Url->build('/orders') ?>"><i class="ph ph-shopping-bag"></i> Purchases</a>
                    </div>
                </div>

                <a href="<?= $this->Url->build('/users/logout') ?>" class="nav-cta" style="background: transparent; border: 1px solid white;">Log Out</a>
            <?php else: ?>
                <a href="<?= $this->Url->build('/users/login') ?>" class="nav-cta">Log In to Book</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="schedule-container">
        <?= $this->Flash->render() ?>
        
        <h1 style="margin-bottom: 10px;">Upcoming Classes</h1>
        <p style="color: #aaa; margin-bottom: 40px;">Reserve your spot in our premium group sessions.</p>

        <?php foreach ($classes as $class): ?>
            <?php 
                $booked = $classStats[$class->ClassID] ?? 0;
                $isFull = $booked >= $class->Capacity;
                $percent = ($class->Capacity > 0) ? min(100, ($booked / $class->Capacity) * 100) : 0;
            ?>
            <div class="class-card">
                <div class="class-info">
                    <h3><?= h($class->ClassName) ?></h3>
                    <div class="class-details">
                        <div><i class="ph-fill ph-clock"></i> <?= $class->StartTime->format('D, M j - g:i A') ?></div>
                        <div><i class="ph-fill ph-user"></i> Trainer: <?= h($class->trainer->FullName ?? 'TBA') ?></div>
                        <div><i class="ph-fill ph-users"></i> <?= $booked ?> / <?= h($class->Capacity) ?> spots</div>
                    </div>
                    <div class="capacity-bar">
                        <div class="capacity-fill <?= $isFull ? 'full' : '' ?>" style="width: <?= $percent ?>%;"></div>
                    </div>
                </div>
                
                <div class="class-actions">
                    <?php if ($isFull): ?>
                        <a href="<?= $this->Url->build(['action' => 'book', $class->ClassID]) ?>" class="btn-book btn-waitlist">Join Waitlist</a>
                    <?php else: ?>
                        <a href="<?= $this->Url->build(['action' => 'book', $class->ClassID]) ?>" class="btn-book">Book Spot</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        
        <?php if ($classes->isEmpty()): ?>
            <div style="text-align: center; padding: 50px; color: #888;">
                <i class="ph ph-calendar-blank" style="font-size: 48px; margin-bottom: 10px;"></i>
                <p>No upcoming classes scheduled at the moment.</p>
            </div>
        <?php endif; ?>
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
