<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trainer Portal | Anytime Fitness</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: var(--bg-dark);
            margin: 0;
            display: flex;
            min-height: 100vh;
            color: white;
            font-family: 'Inter', sans-serif;
        }

        .tp-main {
            flex: 1;
            padding: 40px 60px;
            overflow-y: auto;
        }

        .tp-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        .tp-header h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 32px;
            font-weight: 700;
            margin: 0;
            color: white;
        }
        .tp-header p {
            color: #aaa;
            margin: 5px 0 0 0;
            font-size: 15px;
        }

        /* Flash Messages */
        .flash-msg {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 500;
        }
        .flash-success {
            background: rgba(46,204,113,0.1);
            border: 1px solid rgba(46,204,113,0.3);
            color: #2ecc71;
        }
        .flash-error {
            background: rgba(231,76,60,0.1);
            border: 1px solid rgba(231,76,60,0.3);
            color: #e74c3c;
        }

        /* Class Cards for Dashboard */
        .class-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 25px;
        }
        .class-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .class-header-box {
            padding: 24px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .class-header-box h2 {
            margin: 0 0 8px 0;
            color: var(--primary);
            font-family: 'Outfit', sans-serif;
            font-size: 22px;
        }
        .class-time {
            color: #aaa;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .class-stats {
            text-align: right;
        }
        .class-stats .num {
            font-size: 24px;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            color: white;
        }
        .class-stats .label {
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .roster-area {
            padding: 0;
        }
        .roster-table {
            width: 100%;
            border-collapse: collapse;
        }
        .roster-table th {
            text-align: left;
            padding: 12px 24px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            background: rgba(0,0,0,0.2);
            font-weight: 600;
        }
        .roster-table td {
            padding: 16px 24px;
            font-size: 14px;
            color: #ddd;
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }
        .roster-table tr:last-child td { border-bottom: none; }
        
        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-booked { background: rgba(46,204,113,0.15); color: #2ecc71; }
        .status-waitlist { background: rgba(241,196,15,0.15); color: #f1c40f; }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <?= $this->element('trainer_nav') ?>

    <main class="tp-main">
        <div class="tp-header">
            <div>
                <h1>Trainer Dashboard</h1>
                <p>Welcome back! Here are your assigned classes and rosters.</p>
            </div>
        </div>

        <?php if ($this->Flash->render()): ?>
            <div class="flash-msg flash-success">
                <i class="ph-fill ph-check-circle" style="font-size:20px;"></i>
                <div><?= $this->Flash->render() ?></div>
            </div>
        <?php endif; ?>

        <?php if (empty($classes)): ?>
            <div class="empty-state" style="background: rgba(255,255,255,0.02); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                <i class="ph ph-calendar-blank" style="font-size: 48px; color: #444; margin-bottom: 15px;"></i>
                <p>You have no assigned classes at the moment.</p>
            </div>
        <?php else: ?>
            <div class="chart-container" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 24px; margin-bottom: 30px;">
                <h2 style="margin: 0 0 20px 0; font-family: 'Outfit', sans-serif; font-size: 20px; color: var(--primary);">Class Bookings vs Capacity</h2>
                <canvas id="bookingsChart" height="80"></canvas>
            </div>

            <div class="class-grid">
                <?php foreach ($classes as $class): ?>
                    <div class="class-card">
                        <div class="class-header-box">
                            <div>
                                <h2><?= h($class->ClassName) ?></h2>
                                <div class="class-time"><i class="ph-fill ph-clock"></i> <?= $class->StartTime->format('D, M j - g:i A') ?></div>
                            </div>
                            <div class="class-stats">
                                <div class="num"><?= count($class->bookings) ?> / <?= h($class->Capacity) ?></div>
                                <div class="label">Booked</div>
                            </div>
                        </div>
                        
                        <div class="roster-area">
                            <?php if (empty($class->bookings)): ?>
                                <div class="empty-state">No members booked yet.</div>
                            <?php else: ?>
                                <table class="roster-table">
                                    <thead>
                                        <tr>
                                            <th>Member Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($class->bookings as $booking): ?>
                                            <tr>
                                                <td>
                                                    <div style="font-weight: 500; color: white;"><?= h($booking->user->FullName ?? 'Unknown') ?></div>
                                                    <div style="font-size: 12px; color: #888; margin-top: 2px;"><?= h($booking->user->Email ?? 'N/A') ?></div>
                                                </td>
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
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php if (!empty($classes)): ?>
    <script>
        const ctx = document.getElementById('bookingsChart').getContext('2d');
        
        // Prepare data from PHP
        const classNames = [];
        const bookedData = [];
        const capacityData = [];
        
        <?php foreach ($classes as $class): ?>
            classNames.push('<?= addslashes($class->ClassName) ?>');
            bookedData.push(<?= count($class->bookings) ?>);
            capacityData.push(<?= (int)$class->Capacity ?>);
        <?php endforeach; ?>
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: classNames,
                datasets: [
                    {
                        label: 'Booked',
                        data: bookedData,
                        backgroundColor: 'rgba(138, 43, 226, 0.7)',
                        borderColor: 'rgba(138, 43, 226, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Capacity',
                        data: capacityData,
                        backgroundColor: 'rgba(255, 255, 255, 0.1)',
                        borderColor: 'rgba(255, 255, 255, 0.3)',
                        borderWidth: 1,
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: { color: '#ccc' }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#888', stepSize: 1 },
                        grid: { color: 'rgba(255,255,255,0.05)' }
                    },
                    x: {
                        ticks: { color: '#ccc' },
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
    <?php endif; ?>

</body>
</html>
