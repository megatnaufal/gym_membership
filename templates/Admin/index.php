<?php
$this->assign('title', 'Admin Analytics Dashboard');
?>
<div class="page-header" style="display:flex; justify-content:space-between; align-items:center;">
    <div>
        <h1>Admin Analytics Dashboard</h1>
        <p>Here's what's happening with your gym.</p>
    </div>
    <a href="<?= $this->Url->build('/admin/scanner') ?>" class="action-btn" style="padding: 10px 20px; background: var(--primary); color: white; border-radius: 8px; text-decoration: none; display: flex; align-items: center; gap: 8px; font-weight: bold;">
        <i class="ph ph-qr-code" style="font-size: 20px;"></i>
        QR Scanner
    </a>
</div>

<!-- Metrics -->
<div class="metrics-grid">
    <div class="metric-card">
        <div class="metric-icon users">
            <i class="ph ph-users"></i>
        </div>
        <div class="metric-info">
            <h3><?= h($totalUsers) ?></h3>
            <p>Total Members</p>
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

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-top: 30px;">
    <!-- Revenue Chart -->
    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 24px;">
        <h2 style="margin: 0 0 20px 0; font-family: 'Outfit', sans-serif; font-size: 20px; color: var(--primary);">Monthly Revenue (Last 6 Months)</h2>
        <canvas id="revenueChart" height="100"></canvas>
    </div>

    <!-- Class Popularity Chart -->
    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 24px;">
        <h2 style="margin: 0 0 20px 0; font-family: 'Outfit', sans-serif; font-size: 20px; color: var(--primary);">Top 5 Classes</h2>
        <canvas id="classChart" height="220"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const revCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revCtx, {
        type: 'line',
        data: {
            labels: <?= json_encode($months) ?>,
            datasets: [{
                label: 'Revenue (RM)',
                data: <?= json_encode($revenues) ?>,
                borderColor: 'rgba(138, 43, 226, 1)',
                backgroundColor: 'rgba(138, 43, 226, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#888' },
                    grid: { color: 'rgba(255,255,255,0.05)' }
                },
                x: {
                    ticks: { color: '#ccc' },
                    grid: { display: false }
                }
            }
        }
    });

    // Class Popularity Chart (Pie)
    const classCtx = document.getElementById('classChart').getContext('2d');
    new Chart(classCtx, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($classNames) ?>,
            datasets: [{
                data: <?= json_encode($classBookings) ?>,
                backgroundColor: [
                    'rgba(138, 43, 226, 0.8)',
                    'rgba(46, 204, 113, 0.8)',
                    'rgba(52, 152, 219, 0.8)',
                    'rgba(241, 196, 15, 0.8)',
                    'rgba(231, 76, 60, 0.8)'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#ccc', boxWidth: 12 }
                }
            }
        }
    });
</script>
