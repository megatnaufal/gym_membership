<?php $this->disableAutoLayout(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Dashboard - Anytime Fitness</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body { background: var(--bg-dark); color: white; font-family: 'Inter', sans-serif; }
        .dash-wrap { max-width: 1100px; margin: 0 auto; padding: 50px 24px 80px; }

        /* ── Greeting ── */
        .greeting { margin-bottom: 40px; }
        .greeting h1 { font-size: 32px; font-weight: 800; font-family: 'Outfit', sans-serif; margin-bottom: 4px; }
        .greeting p { color: #aaa; font-size: 15px; }

        /* ── Stats Row ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        .stat-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 18px;
            padding: 24px 28px;
            display: flex;
            align-items: center;
            gap: 20px;
            backdrop-filter: blur(16px);
            transition: transform 0.3s ease;
        }
        .stat-card:hover { transform: translateY(-4px); }
        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
        }
        .si-membership { background: rgba(138,43,226,.18); color: var(--primary); }
        .si-classes    { background: rgba(0,210,255,.15);  color: #00d2ff; }
        .si-lessons    { background: rgba(46,204,113,.15); color: #2ecc71; }
        .si-days       { background: rgba(243,156,18,.15); color: #f39c12; }
        .stat-info h3  { font-size: 28px; font-weight: 800; font-family: 'Outfit', sans-serif; margin: 0 0 3px; }
        .stat-info p   { font-size: 13px; color: #aaa; margin: 0; }

        /* ── Section header ── */
        .section-hdr {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 18px;
        }
        .section-hdr h2 { font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; }

        /* ── Membership card ── */
        .mem-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 28px 32px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }
        .mem-card::before {
            content: '';
            position: absolute; inset: 0 0 auto 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }
        .mem-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; margin-top: 20px; }
        .mem-item label { font-size: 11px; text-transform: uppercase; letter-spacing: .8px; color: #666; display: block; margin-bottom: 4px; }
        .mem-item span  { font-size: 16px; font-weight: 700; }

        /* ── Class cards ── */
        .class-list { display: flex; flex-direction: column; gap: 14px; margin-bottom: 40px; }
        .class-row {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 14px;
            padding: 18px 24px;
            display: flex; align-items: center; justify-content: space-between;
            gap: 16px;
            transition: background 0.2s;
        }
        .class-row:hover { background: rgba(255,255,255,.07); }
        .class-row .cr-info h4 { font-family: 'Outfit', sans-serif; font-size: 17px; margin: 0 0 4px; }
        .class-row .cr-info p  { font-size: 13px; color: #aaa; margin: 0; }
        .pill-booked   { background: rgba(46,204,113,.15); color:#2ecc71; padding:3px 10px; border-radius:12px; font-size:12px; font-weight:700; }
        .pill-waitlist { background: rgba(231,76,60,.15);  color:#e74c3c; padding:3px 10px; border-radius:12px; font-size:12px; font-weight:700; }
        .btn-cancel-sm {
            color: #e74c3c; font-size:12px; font-weight:700; text-decoration:none;
            padding: 4px 12px; border:1px solid rgba(231,76,60,.3); border-radius:8px;
            transition: background .2s;
        }
        .btn-cancel-sm:hover { background: rgba(231,76,60,.1); color:#e74c3c; }

        /* ── Next lesson ── */
        .lesson-card {
            background: linear-gradient(135deg, rgba(138,43,226,.15) 0%, rgba(0,210,255,.08) 100%);
            border: 1px solid rgba(138,43,226,.3);
            border-radius: 20px;
            padding: 28px 32px;
            margin-bottom: 40px;
            display: flex; align-items: center; gap: 24px;
        }
        .lesson-icon { font-size: 48px; color: var(--primary); flex-shrink: 0; }
        .lesson-info h3 { font-family: 'Outfit', sans-serif; font-size: 20px; margin: 0 0 6px; }
        .lesson-info p  { color: #aaa; font-size: 14px; margin: 0; }
        .lesson-info .lesson-dt { font-size: 22px; font-weight: 800; color: white; font-family: 'Outfit', sans-serif; margin: 4px 0; }

        /* ── Empty state ── */
        .empty-card {
            background: var(--glass-bg);
            border: 1px dashed var(--glass-border);
            border-radius: 16px;
            padding: 40px 20px;
            text-align: center;
            color: #555;
            margin-bottom: 40px;
        }
        .empty-card i { font-size: 40px; display: block; margin-bottom: 10px; }
    </style>
</head>
<body>

<?= $this->element('navbar', ['active' => 'dashboard', 'user' => $user, 'activeMembership' => $activeMembership]) ?>

<?= $this->Flash->render() ?>

<div class="dash-wrap">

    <!-- Greeting -->
    <div class="greeting">
        <h1>👋 Welcome back, <?= h($user->FullName ?? 'Member') ?>!</h1>
        <p><?= date('l, d F Y') ?> — Here's your fitness overview.</p>
    </div>

    <!-- Stats Row -->
    <?php
        $daysLeft = null;
        if ($activeMembership) {
            $end = $activeMembership->EndDate;
            $endDt = is_object($end) && method_exists($end, 'toNative') ? $end->toNative() : new \DateTime((string)$end);
            $daysLeft = max(0, (int)(new \DateTime())->diff($endDt)->days);
        }
    ?>
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon si-membership"><i class="ph ph-identification-card"></i></div>
            <div class="stat-info">
                <h3><?= $activeMembership ? h($activeMembership->package->PackageName ?? 'Active') : 'None' ?></h3>
                <p>Membership Plan</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-classes"><i class="ph ph-calendar-check"></i></div>
            <div class="stat-info">
                <h3><?= $totalBooked ?></h3>
                <p>Classes Booked</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-lessons"><i class="ph ph-chalkboard-teacher"></i></div>
            <div class="stat-info">
                <h3><?= $totalLessons ?></h3>
                <p>1-on-1 Sessions</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-days"><i class="ph ph-clock-countdown"></i></div>
            <div class="stat-info">
                <h3><?= $daysLeft !== null ? $daysLeft : '—' ?></h3>
                <p>Days Until Expiry</p>
            </div>
        </div>
    </div>

    <!-- Next 1-on-1 Session -->
    <div class="section-hdr">
        <h2><i class="ph ph-chalkboard-teacher" style="color:var(--primary);"></i> Next Private Session</h2>
        <a href="<?= $this->Url->build('/private-coaching') ?>" class="btn btn-primary" style="padding:8px 18px;font-size:13px;">+ Book 1-on-1</a>
    </div>

    <?php if ($nextLesson): ?>
        <?php
            $ldt = $nextLesson->LessonDateTime;
            $dtFmt = is_object($ldt) && method_exists($ldt, 'format') ? $ldt->format('D, d M Y') : date('D, d M Y', strtotime((string)$ldt));
            $tmFmt = is_object($ldt) && method_exists($ldt, 'format') ? $ldt->format('g:i A')    : date('g:i A',    strtotime((string)$ldt));
        ?>
        <div class="lesson-card">
            <i class="ph-fill ph-chalkboard-teacher lesson-icon"></i>
            <div class="lesson-info">
                <h3>1-on-1 with <?= h($nextLessonTrainerName) ?></h3>
                <p class="lesson-dt"><?= h($dtFmt) ?> at <?= h($tmFmt) ?></p>
                <p>Status: <strong><?= h($nextLesson->Status) ?></strong></p>
            </div>
            <a href="<?= $this->Url->build('/coaching/cancel-lesson/' . $nextLesson->LessonID) ?>"
               onclick="return confirm('Cancel this session?')"
               class="btn-cancel-sm" style="margin-left:auto; flex-shrink:0;">
               <i class="ph ph-x-circle"></i> Cancel
            </a>
        </div>
    <?php else: ?>
        <div class="empty-card">
            <i class="ph ph-chalkboard-teacher"></i>
            <p>No upcoming private sessions.</p>
            <a href="<?= $this->Url->build('/private-coaching') ?>" class="btn btn-primary" style="margin-top:14px;padding:10px 20px;font-size:13px;">Book a Trainer</a>
        </div>
    <?php endif; ?>

    <!-- Upcoming Classes -->
    <div class="section-hdr">
        <h2><i class="ph ph-calendar-check" style="color:var(--primary);"></i> Upcoming Classes</h2>
        <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary" style="padding:8px 18px;font-size:13px;">Browse Schedule</a>
    </div>

    <?php if (!empty($upcomingBookings)): ?>
        <div class="class-list">
            <?php foreach (array_slice($upcomingBookings, 0, 5) as $booking): ?>
                <?php $class = $booking->gym_class ?? null; if (!$class) continue; ?>
                <?php
                    $st = $class->StartTime;
                    $classDate = is_object($st) && method_exists($st,'format') ? $st->format('D, d M Y') : date('D, d M Y', strtotime((string)$st));
                    $classTime = is_object($st) && method_exists($st,'format') ? $st->format('g:i A')    : date('g:i A',    strtotime((string)$st));
                    $status = $booking->AttendanceStatus ?? 'Booked';
                ?>
                <div class="class-row">
                    <div class="cr-info">
                        <h4><?= h($class->ClassName) ?></h4>
                        <p><i class="ph ph-clock"></i> <?= h($classDate) ?> at <?= h($classTime) ?> &nbsp;|&nbsp; <i class="ph ph-user"></i> <?= h($class->trainer->FullName ?? 'TBA') ?></p>
                    </div>
                    <div style="display:flex; align-items:center; gap:14px; flex-shrink:0;">
                        <span class="<?= strtolower($status) === 'waitlisted' ? 'pill-waitlist' : 'pill-booked' ?>"><?= h($status) ?></span>
                        <a href="<?= $this->Url->build('/schedule/cancel/' . $booking->BookingID) ?>"
                           onclick="return confirm('Cancel this class booking?')"
                           class="btn-cancel-sm">
                           <i class="ph ph-x-circle"></i> Cancel
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-card">
            <i class="ph ph-calendar-x"></i>
            <p>No upcoming class bookings.</p>
            <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary" style="margin-top:14px;padding:10px 20px;font-size:13px;">Book a Class</a>
        </div>
    <?php endif; ?>

    <!-- Membership Card -->
    <div class="section-hdr">
        <h2><i class="ph ph-identification-card" style="color:var(--primary);"></i> Membership Details</h2>
        <a href="<?= $this->Url->build('/memberships/status') ?>" class="btn btn-primary" style="padding:8px 18px;font-size:13px;">Full Status</a>
    </div>

    <?php if ($activeMembership): ?>
        <div class="mem-card">
            <span style="display:inline-flex; align-items:center; gap:8px; padding:5px 14px; border-radius:20px; font-size:12px; font-weight:700; text-transform:uppercase; background:rgba(46,204,113,.15); color:#2ecc71; margin-bottom:8px;">
                <i class="ph ph-check-circle"></i> Active
            </span>
            <div class="mem-grid">
                <div class="mem-item"><label>Package</label><span><?= h($activeMembership->package->PackageName ?? '—') ?></span></div>
                <div class="mem-item"><label>Price</label><span>RM <?= number_format($activeMembership->package->Price ?? 0, 2) ?></span></div>
                <div class="mem-item">
                    <label>Start Date</label>
                    <?php $sd = $activeMembership->StartDate; ?>
                    <span><?= is_object($sd) && method_exists($sd,'format') ? $sd->format('d M Y') : date('d M Y', strtotime((string)$sd)) ?></span>
                </div>
                <div class="mem-item">
                    <label>Expiry Date</label>
                    <?php $ed = $activeMembership->EndDate; ?>
                    <span><?= is_object($ed) && method_exists($ed,'format') ? $ed->format('d M Y') : date('d M Y', strtotime((string)$ed)) ?></span>
                </div>
                <div class="mem-item"><label>Days Remaining</label><span><?= $daysLeft ?> days</span></div>
            </div>
        </div>
    <?php else: ?>
        <div class="empty-card">
            <i class="ph ph-identification-card"></i>
            <p>No active membership. Join a package to unlock class bookings!</p>
            <a href="<?= $this->Url->build('/') ?>#pricing" class="btn btn-primary" style="margin-top:14px;padding:10px 20px;font-size:13px;">Browse Plans</a>
        </div>
    <?php endif; ?>

</div><!-- /dash-wrap -->

<?= $this->element('footer') ?>
</body>
</html>
