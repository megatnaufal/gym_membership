<?php
$this->disableAutoLayout();

// Calculate days remaining and progress for active membership
$daysRemaining = null;
$totalDays     = null;
$progressPct   = 0;
$isExpired     = false;

if ($membership) {
    $today    = new \DateTime();
    $start    = $membership->StartDate->toNative();
    $end      = $membership->EndDate->toNative();
    $diff     = $today->diff($end);
    $isExpired = $today > $end;

    if (!$isExpired) {
        $daysRemaining = (int)$diff->days;
        $totalDays     = (int)$start->diff($end)->days;
        $progressPct   = $totalDays > 0
            ? min(100, round((($totalDays - $daysRemaining) / $totalDays) * 100))
            : 100;
    }

    $status = strtolower($membership->Status ?? '');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Membership Status - Anytime Fitness</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body { background: var(--bg-dark); color: white; }

        .page-wrapper { max-width: 900px; margin: 0 auto; padding: 60px 24px 80px; }

        /* ── Header ── */
        .page-heading { margin-bottom: 40px; }
        .page-heading h1 { font-size: 36px; font-weight: 800; font-family: 'Outfit', sans-serif; }
        .page-heading p  { color: #aaa; margin-top: 6px; font-family: 'Inter', sans-serif; }

        /* ── Status card ── */
        .status-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 32px;
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow: var(--glass-shadow);
            position: relative;
            overflow: hidden;
        }
        .status-card::before {
            content: '';
            position: absolute;
            inset: 0 0 auto 0;
            height: 4px;
            background: var(--primary);
        }
        .status-card.expired::before { background: #e74c3c; }

        .status-badge-lg {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 24px;
        }
        .badge-active   { background: rgba(46,204,113,.15); color: #2ecc71; border: 1px solid rgba(46,204,113,.3); }
        .badge-expired  { background: rgba(231,76,60,.15);  color: #e74c3c; border: 1px solid rgba(231,76,60,.3); }
        .badge-inactive { background: rgba(189,195,199,.15);color: #bdc3c7; border: 1px solid rgba(189,195,199,.3); }

        /* ── Info grid ── */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }
        .info-item label {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            margin-bottom: 6px;
        }
        .info-item span {
            font-size: 18px;
            font-weight: 700;
            color: white;
            font-family: 'Outfit', sans-serif;
        }

        /* ── Progress bar ── */
        .progress-section { margin-bottom: 8px; }
        .progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #888;
            margin-bottom: 8px;
        }
        .progress-bar {
            height: 8px;
            background: rgba(255,255,255,0.08);
            border-radius: 4px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 4px;
            background: var(--primary);
            transition: width 0.6s ease;
        }
        .progress-fill.danger { background: #e74c3c; }

        /* ── Bookings table ── */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .section-header h2 { font-size: 26px; font-weight: 700; font-family: 'Outfit', sans-serif; }
        .bookings-table-wrap {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--glass-shadow);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            padding: 14px 20px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        tbody tr { border-bottom: 1px solid rgba(255,255,255,0.04); transition: background 0.2s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(255,255,255,0.03); }
        tbody td { padding: 16px 20px; font-size: 14px; color: #ccc; }
        tbody td:first-child { color: white; font-weight: 600; }

        .pill {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
        }
        .pill-booked   { background: rgba(46,204,113,.15); color: #2ecc71; }
        .pill-waitlist { background: rgba(231,76,60,.15);  color: #e74c3c; }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #555;
        }
        .empty-state i { font-size: 44px; display: block; margin-bottom: 12px; }

        /* ── No membership ── */
        .no-membership {
            text-align: center;
            padding: 60px 20px;
            background: var(--glass-bg);
            border: 1px dashed var(--glass-border);
            border-radius: 20px;
            margin-bottom: 32px;
        }
        .no-membership i { font-size: 56px; color: #444; display: block; margin-bottom: 16px; }
        .no-membership h3 { font-size: 22px; margin-bottom: 10px; }
        .no-membership p  { color: #666; margin-bottom: 24px; }
    </style>
</head>
<body>

<!-- Navbar -->
<?= $this->element('navbar', ['active' => 'membership', 'user' => $user]) ?>

<!-- Page Content -->
<div class="page-wrapper">

    <div class="page-heading">
        <h1><i class="ph ph-identification-card" style="color:var(--primary);"></i> Membership Status</h1>
        <p>Welcome back, <?= h($user->FullName) ?>. Here are your current membership details.</p>
    </div>

    <?= $this->Flash->render() ?>

    <!-- ── Membership Details ── -->
    <?php if ($membership): ?>
        <?php
            $badgeClass = 'badge-inactive';
            $cardClass  = '';
            if ($isExpired) {
                $badgeClass = 'badge-expired';
                $cardClass  = 'expired';
            } elseif ($status === 'active') {
                $badgeClass = 'badge-active';
            }
        ?>
        <div class="status-card <?= $cardClass ?>">

            <span class="status-badge-lg <?= $badgeClass ?>">
                <i class="ph ph-<?= $isExpired ? 'warning' : ($status === 'active' ? 'check-circle' : 'clock') ?>"></i>
                <?= $isExpired ? 'Expired' : h(ucfirst($status)) ?>
            </span>

            <div class="info-grid">
                <div class="info-item">
                    <label>Package</label>
                    <span><?= h($membership->package->PackageName ?? '—') ?></span>
                </div>
                <div class="info-item">
                    <label>Billing Cycle</label>
                    <span><?= h(ucfirst($membership->package->BillingCycle ?? '—')) ?></span>
                </div>
                <div class="info-item">
                    <label>Price</label>
                    <span>RM <?= h(number_format((float)($membership->package->Price ?? 0), 2)) ?></span>
                </div>
                <div class="info-item">
                    <label>Start Date</label>
                    <span><?= h($membership->StartDate->format('d M Y')) ?></span>
                </div>
                <div class="info-item">
                    <label>Expiry Date</label>
                    <span><?= h($membership->EndDate->format('d M Y')) ?></span>
                </div>
                <div class="info-item">
                    <label>Days Remaining</label>
                    <span><?= $isExpired ? '<span style="color:#e74c3c;">Expired</span>' : h($daysRemaining . ' days') ?></span>
                </div>
            </div>

            <?php if (!$isExpired && $totalDays > 0): ?>
            <div class="progress-section">
                <div class="progress-label">
                    <span>Membership Progress</span>
                    <span><?= $progressPct ?>% used — <?= $daysRemaining ?> days left</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill <?= $progressPct >= 85 ? 'danger' : '' ?>"
                         style="width: <?= $progressPct ?>%;"></div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($isExpired): ?>
            <div style="margin-top:20px;">
                <a href="<?= $this->Url->build('/private-coaching') ?>" class="btn btn-primary">
                    <i class="ph ph-arrow-clockwise"></i> Renew Membership
                </a>
            </div>
            <?php endif; ?>
        </div>

    <?php else: ?>
        <div class="no-membership">
            <i class="ph ph-identification-card"></i>
            <h3>No Membership Found</h3>
            <p>You do not have an active membership plan. Join one of our coaching packages to get started.</p>
            <a href="<?= $this->Url->build('/private-coaching') ?>" class="btn btn-primary">Browse Packages</a>
        </div>
    <?php endif; ?>

    <!-- ── Booked Classes ── -->
    <div class="section-header">
        <h2><i class="ph ph-calendar-check" style="color:var(--primary);"></i> My Booked Classes</h2>
        <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary" style="padding:10px 20px; font-size:13px;">
            <i class="ph ph-plus"></i> Book a Class
        </a>
    </div>

    <div class="bookings-table-wrap">
        <?php if (!empty($bookings)): ?>
        <table>
            <thead>
                <tr>
                    <th>Class</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <?php $class = $booking->gym_class ?? null; ?>
                    <?php if ($class): ?>
                    <tr>
                        <td><?= h($class->ClassName) ?></td>
                        <td><?= h($class->StartTime->format('D, d M Y')) ?></td>
                        <td><?= h($class->StartTime->format('h:i A')) ?> – <?= h($class->EndTime->format('h:i A')) ?></td>
                        <td>
                            <?php $s = $booking->AttendanceStatus ?? 'Booked'; ?>
                            <span class="pill <?= strtolower($s) === 'waitlisted' ? 'pill-waitlist' : 'pill-booked' ?>">
                                <?= h($s) ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= $this->Url->build('/schedule/cancel/' . $booking->BookingID) ?>"
                               onclick="return confirm('Cancel this booking?')"
                               style="color:#e74c3c; font-size:13px; font-weight:600; text-decoration:none;">
                                <i class="ph ph-x-circle"></i> Cancel
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="empty-state">
            <i class="ph ph-calendar-x"></i>
            <p>You have not booked any classes yet.</p>
            <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary" style="margin-top:12px;">Browse Classes</a>
        </div>
        <?php endif; ?>
    </div>

</div><!-- /page-wrapper -->

<script>
function toggleDropdown(event) {
    event.stopPropagation();
    document.getElementById("profileDropdown").classList.toggle("show");
}
window.onclick = function(event) {
    if (!event.target.matches(".profile-avatar") && !event.target.closest(".profile-avatar")) {
        var menus = document.getElementsByClassName("dropdown-menu");
        for (var i = 0; i < menus.length; i++) {
            menus[i].classList.remove("show");
        }
    }
};
</script>
</body>
</html>
