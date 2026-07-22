<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Class Schedule - Anytime Fitness</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <?= $this->Html->css(['anytime_home']) ?>
    <?= $this->Html->script('animations', ['defer' => true]) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        .schedule-container {
            max-width: 1000px;
            margin: 60px auto;
            padding: 0 20px;
        }
        .class-card {
            background: var(--glass-bg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.5);
            transition: all 0.4s ease;
        }
        .class-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 15px 40px -10px rgba(138,43,226,0.2);
        }
        .class-info h3 { margin: 0 0 5px 0; color: white; font-family: 'Outfit', sans-serif; font-size: 22px; font-weight: 600; }
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
            padding: 12px 28px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-book:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(138,43,226,0.4); color: white; }
        .btn-waitlist {
            background: transparent;
            border: 2px solid #e74c3c;
            color: #e74c3c;
        }
        .btn-waitlist:hover { background: rgba(231, 76, 60, 0.1); color: #e74c3c; }
        .btn-booked {
            padding: 12px 24px;
            background: rgba(46, 204, 113, 0.12);
            color: #2ecc71;
            border: 2px solid rgba(46, 204, 113, 0.35);
            border-radius: 8px;
            font-weight: bold;
            cursor: default;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .btn-staff-only {
            padding: 10px 20px;
            background: rgba(255,255,255,0.04);
            color: #888;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: default;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }
        /* Membership banner */
        .membership-banner {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 20px 30px;
            margin-bottom: 36px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: var(--glass-shadow);
        }
        .membership-banner.expired { border-color: rgba(231,76,60,0.4); }
        .banner-info { display: flex; align-items: center; gap: 14px; }
        .banner-icon { font-size: 28px; }
        .banner-text h4 { font-size: 15px; font-weight: 700; margin: 0 0 4px; color: white; }
        .banner-text p  { font-size: 13px; color: #888; margin: 0; }
        .banner-pill {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .pill-active   { background: rgba(46,204,113,.15); color: #2ecc71; }
        .pill-expired  { background: rgba(231,76,60,.15);  color: #e74c3c; }
        .pill-none     { background: rgba(189,195,199,.1); color: #888; }
    </style>
</head>
<body style="background: var(--bg-dark); color: white;">

    <?= $this->element('navbar', ['active' => 'schedule']) ?>

    <div class="schedule-container">
        <?= $this->Flash->render() ?>

        <h1 class="reveal" style="margin-bottom: 10px; font-family: 'Outfit', sans-serif; font-weight: 700;">Upcoming <span class="text-gradient">Classes</span></h1>
        <p class="reveal" style="color: #aaa; margin-bottom: 30px; font-family: 'Inter', sans-serif;">Reserve your spot in our premium group sessions.</p>

        <?php if ($user && $membershipStatus): ?>
            <?php
                $today     = new \DateTime();
                $endDate   = $membershipStatus->EndDate->toNative();
                $expired   = $today > $endDate;
                $daysLeft  = $expired ? 0 : (int)$today->diff($endDate)->days;
                $mStatus   = strtolower($membershipStatus->Status ?? '');
            ?>
            <div class="membership-banner reveal <?= $expired ? 'expired' : '' ?>">
                <div class="banner-info">
                    <i class="ph ph-identification-card banner-icon" style="color: <?= $expired ? '#e74c3c' : 'var(--primary)' ?>;"></i>
                    <div class="banner-text">
                        <h4 style="font-family: 'Outfit', sans-serif; font-size: 18px;">
                            <?= h($membershipStatus->package->PackageName ?? 'Membership') ?>
                            &nbsp;<span class="banner-pill <?= $expired ? 'pill-expired' : 'pill-active' ?>">
                                <?= $expired ? 'Expired' : 'Active' ?>
                            </span>
                        </h4>
                        <p>
                            <?php if ($expired): ?>
                                Your membership expired on <?= h($endDate->format('d M Y')) ?>.
                            <?php else: ?>
                                <?= $daysLeft ?> day<?= $daysLeft !== 1 ? 's' : '' ?> remaining &mdash;
                                expires <?= h($endDate->format('d M Y')) ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <a href="<?= $this->Url->build('/memberships/status') ?>" class="btn btn-primary" style="padding: 10px 20px; font-size: 13px; white-space: nowrap;">
                    <i class="ph ph-arrow-right"></i> View Full Status
                </a>
            </div>
        <?php elseif ($user): ?>
            <div class="membership-banner reveal">
                <div class="banner-info">
                    <i class="ph ph-warning banner-icon" style="color: #f39c12;"></i>
                    <div class="banner-text">
                        <h4>No Active Membership &nbsp;<span class="banner-pill pill-none">None</span></h4>
                        <p>You need a membership to book classes. Join a package to get started.</p>
                    </div>
                </div>
                <a href="<?= $this->Url->build('/private-coaching') ?>" class="btn btn-primary" style="padding: 10px 20px; font-size: 13px; white-space: nowrap;">
                    <i class="ph ph-plus"></i> Get a Membership
                </a>
            </div>
        <?php endif; ?>

        <?php foreach ($classes as $class): ?>
            <?php 
                $booked = $classStats[$class->ClassID] ?? 0;
                $isFull = $booked >= $class->Capacity;
                $percent = ($class->Capacity > 0) ? min(100, ($booked / $class->Capacity) * 100) : 0;
            ?>
            <div class="class-card reveal">
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
                    <?php if (isset($user) && strtolower($user->Role ?? $user['Role'] ?? '') === 'trainer'): ?>
                        <span class="btn-staff-only">
                            <i class="ph ph-prohibit"></i> Staff — Observer Only
                        </span>
                    <?php elseif (!empty($bookedClassIds[$class->ClassID])): ?>
                        <span class="btn-booked">
                            <i class="ph-fill ph-check-circle"></i> Booked
                        </span>
                    <?php elseif ($isFull): ?>
                        <a href="<?= $this->Url->build('/schedule/book/' . $class->ClassID) ?>" class="btn-book btn-waitlist">Join Waitlist</a>
                    <?php else: ?>
                        <a href="<?= $this->Url->build('/schedule/book/' . $class->ClassID) ?>" class="btn-book">Book Spot</a>
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

    <?= $this->element('footer') ?>
</body>
</html>
