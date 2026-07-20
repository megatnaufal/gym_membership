<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Anytime Fitness - Your Receipt</title>
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        .thank-you-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-dark);
            padding: 40px 20px;
        }
        .thank-you-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 50px 40px;
            max-width: 620px;
            width: 100%;
            backdrop-filter: blur(20px);
            text-align: center;
        }
        .check-circle {
            width: 90px;
            height: 90px;
            background: rgba(46, 204, 113, 0.15);
            border: 2px solid rgba(46, 204, 113, 0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 28px;
        }
        .check-circle i { font-size: 44px; color: #2ecc71; }
        h1 { font-size: 30px; margin-bottom: 8px; color: white; }
        .subtitle { color: #aaa; font-size: 15px; margin-bottom: 32px; }
        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 0 32px;
            text-align: left;
        }
        .receipt-table tr { border-bottom: 1px solid rgba(255,255,255,0.07); }
        .receipt-table tr:last-child { border-bottom: none; }
        .receipt-table td { padding: 12px 6px; font-size: 14px; color: #ccc; }
        .receipt-table td:first-child { color: #888; font-weight: 500; width: 42%; }
        .receipt-table td:last-child { color: white; font-weight: 600; }
        .price-row td:last-child { color: var(--primary); font-size: 18px; }
        .redirect-text {
            color: #666;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
        }
    </style>
    <script>
        setTimeout(function() {
            window.location.href = "<?= $this->Url->build('/') ?>";
        }, 8000);
    </script>
</head>
<body>

<div class="thank-you-wrapper">
    <div class="thank-you-card">
        <div class="check-circle">
            <i class="ph-fill ph-check-circle"></i>
        </div>

        <?php if (!empty($receipt)): ?>
            <h1>Welcome, <?= h($receipt['fullName']) ?>!</h1>
            <p class="subtitle">Your membership is now active. Here is your receipt summary.</p>

            <table class="receipt-table">
                <tr>
                    <td>Name</td>
                    <td><?= h($receipt['fullName']) ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?= h($receipt['email']) ?></td>
                </tr>
                <tr>
                    <td>Package</td>
                    <td><?= h($receipt['packageName']) ?></td>
                </tr>
                <tr>
                    <td>Billing Cycle</td>
                    <td><?= h(ucfirst($receipt['billing'])) ?></td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td><?= h($receipt['startDate']) ?></td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td><?= h($receipt['endDate']) ?></td>
                </tr>
                <tr class="price-row">
                    <td>Amount Paid</td>
                    <td>RM <?= h(number_format((float)$receipt['price'], 2)) ?></td>
                </tr>
            </table>
        <?php else: ?>
            <h1>Welcome to Anytime Fitness!</h1>
            <p class="subtitle">Your membership has been successfully activated.</p>
        <?php endif; ?>

        <a href="<?= $this->Url->build('/') ?>" class="btn btn-primary" style="display: inline-block; padding: 12px 32px; margin-bottom: 24px;">
            Return to Homepage
        </a>

        <div class="redirect-text">
            <i class="ph ph-spinner-gap" style="animation: spin 1s linear infinite;"></i>
            Redirecting to homepage in a few seconds...
        </div>
    </div>
</div>

<style>
@keyframes spin { 100% { transform: rotate(360deg); } }
</style>

</body>
</html>
