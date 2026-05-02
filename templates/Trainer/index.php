<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trainer Dashboard</title>
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        .dashboard-container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .class-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
        }
        .class-header { display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px; margin-bottom: 15px; }
        .roster-table { width: 100%; border-collapse: collapse; }
        .roster-table th, .roster-table td { padding: 12px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .roster-table th { color: #888; font-size: 12px; text-transform: uppercase; }
        .status-badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .status-booked { background: rgba(46, 204, 113, 0.2); color: #2ecc71; }
        .status-waitlist { background: rgba(231, 76, 60, 0.2); color: #e74c3c; }
    </style>
</head>
<body style="background: var(--bg-dark); color: white;">

    <nav class="navbar" style="background: rgba(15, 15, 17, 0.95); position: sticky; z-index: 100;">
        <div class="nav-brand"><a href="/">Trainer<span>Portal</span></a></div>
        <div class="nav-links">
            <span style="color: #aaa;">Welcome, <?= h($user->FullName) ?></span>
        </div>
        <div style="display: flex; align-items: center; gap: 15px;">
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
                </div>
            </div>

            <a href="<?= $this->Url->build('/users/logout') ?>" class="nav-cta" style="background: transparent; border: 1px solid white;">Log Out</a>
        </div>
    </nav>

    <div class="dashboard-container">
        <h1>Your Assigned Classes</h1>
        <p style="color: #aaa;">View your upcoming schedule and member rosters.</p>
        
        <?php foreach ($classes as $class): ?>
            <div class="class-card">
                <div class="class-header">
                    <div>
                        <h2 style="margin: 0; color: var(--primary);"><?= h($class->ClassName) ?></h2>
                        <div style="color: #aaa; margin-top: 5px;"><i class="ph-fill ph-clock"></i> <?= $class->StartTime->format('D, M j - g:i A') ?></div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 24px; font-weight: bold;"><?= count($class->bookings) ?> / <?= h($class->Capacity) ?></div>
                        <div style="color: #888; font-size: 12px;">Total Booked</div>
                    </div>
                </div>
                
                <?php if (empty($class->bookings)): ?>
                    <p style="color: #666; text-align: center; padding: 20px;">No members have booked this class yet.</p>
                <?php else: ?>
                    <table class="roster-table">
                        <thead>
                            <tr>
                                <th>Member Name</th>
                                <th>Email</th>
                                <th>Booked On</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($class->bookings as $booking): ?>
                                <tr>
                                    <td><?= h($booking->member->FullName ?? 'Unknown') ?></td>
                                    <td><?= h($booking->member->Email ?? 'N/A') ?></td>
                                    <td><?= $booking->BookingDate->format('M j, Y') ?></td>
                                    <td>
                                        <span class="status-badge <?= strtolower($booking->AttendanceStatus) == 'waitlisted' ? 'status-waitlist' : 'status-booked' ?>">
                                            <?= h($booking->AttendanceStatus) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
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
