<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Private Coaching Bookings | Anytime Fitness</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
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

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255,255,255,0.02);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .data-table th {
            text-align: left;
            padding: 16px 24px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            background: rgba(0,0,0,0.2);
            font-weight: 600;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .data-table td {
            padding: 16px 24px;
            font-size: 14px;
            color: #ddd;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            vertical-align: middle;
        }
        .data-table tr:hover td {
            background: rgba(255,255,255,0.02);
        }
        .data-table tr:last-child td { border-bottom: none; }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-confirmed {
            background: rgba(46,204,113,0.1);
            color: #2ecc71;
            border: 1px solid rgba(46,204,113,0.3);
        }
    </style>
</head>
<body>

    <?= $this->element('trainer_nav') ?>

    <main class="tp-main">
        <div class="tp-header">
            <div>
                <h1>1-on-1 Coaching Bookings</h1>
                <p>View your upcoming private sessions with members.</p>
            </div>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Member Name</th>
                    <th>Trainer</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessons as $lesson): ?>
                <tr>
                    <td>
                        <div style="color: white; font-weight: 600;"><?= $lesson->LessonDateTime->format('M j, Y') ?></div>
                        <div style="font-size: 12px; color: #888; margin-top: 2px;"><i class="ph ph-clock"></i> <?= $lesson->LessonDateTime->format('g:i A') ?></div>
                    </td>
                    <td style="color: white;"><?= h($lesson->user->FullName ?? 'Unknown Member') ?></td>
                    <td style="color: white; font-weight: 600;"><?= h($lesson->trainer->FullName ?? 'Unknown Trainer') ?></td>
                    <td style="color: #aaa;"><?= h($lesson->user->Email ?? 'N/A') ?></td>
                    <td>
                        <span class="status-badge status-confirmed">
                            <i class="ph-fill ph-check-circle"></i> Confirmed
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (count($lessons) === 0): ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #666;">
                        <i class="ph ph-calendar-blank" style="font-size: 32px; margin-bottom: 10px; display: block;"></i>
                        No private sessions booked yet.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

</body>
</html>
