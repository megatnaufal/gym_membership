<?php $this->disableAutoLayout(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Successful – Anytime Fitness</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            background: var(--bg-dark);
            background-image:
                radial-gradient(circle at top right, rgba(46,204,113,0.12) 0%, transparent 40%),
                radial-gradient(circle at bottom left, rgba(138,43,226,0.1) 0%, transparent 40%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .success-container {
            width: 100%;
            max-width: 680px;
        }

        /* ── Confetti animation ── */
        .confetti-row {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 24px;
            animation: confetti-fall 0.6s ease both;
        }
        @keyframes confetti-fall {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .confetti-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            animation: bounce 1.2s ease infinite;
        }
        .confetti-dot:nth-child(1) { background: #2ecc71; animation-delay: 0s; }
        .confetti-dot:nth-child(2) { background: var(--primary); animation-delay: 0.1s; }
        .confetti-dot:nth-child(3) { background: var(--secondary); animation-delay: 0.2s; }
        .confetti-dot:nth-child(4) { background: #f39c12; animation-delay: 0.3s; }
        .confetti-dot:nth-child(5) { background: #e74c3c; animation-delay: 0.4s; }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-8px); }
        }

        /* ── Card ── */
        .success-card {
            background: var(--glass-bg);
            border: 1px solid rgba(46,204,113,0.25);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,0.5), 0 0 40px rgba(46,204,113,0.08);
            animation: card-in 0.5s cubic-bezier(0.34,1.56,0.64,1) both;
        }
        @keyframes card-in {
            from { opacity: 0; transform: translateY(40px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ── Green header strip ── */
        .success-header {
            background: linear-gradient(135deg, rgba(46,204,113,0.2), rgba(46,204,113,0.05));
            border-bottom: 1px solid rgba(46,204,113,0.2);
            padding: 40px 40px 32px;
            text-align: center;
        }
        .check-ring {
            width: 90px; height: 90px;
            border-radius: 50%;
            background: rgba(46,204,113,0.15);
            border: 2px solid rgba(46,204,113,0.45);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            animation: ring-pulse 2.5s ease infinite;
        }
        @keyframes ring-pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(46,204,113,0.3); }
            50%       { box-shadow: 0 0 0 12px rgba(46,204,113,0); }
        }
        .check-ring i { font-size: 46px; color: #2ecc71; }
        .success-title {
            font-family: 'Outfit', sans-serif;
            font-size: 32px;
            font-weight: 800;
            color: white;
            margin: 0 0 8px;
        }
        .success-sub {
            color: #aaa;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
        }

        /* ── Receipt body ── */
        .receipt-body { padding: 36px 40px; }

        /* Transaction ID badge */
        .txn-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(138,43,226,0.12);
            border: 1px solid rgba(138,43,226,0.3);
            border-radius: 10px;
            padding: 10px 18px;
            margin-bottom: 28px;
            font-family: 'Inter', monospace;
            font-size: 13px;
            color: var(--primary);
            font-weight: 600;
            width: 100%;
            justify-content: center;
            word-break: break-all;
        }

        /* Receipt rows */
        .receipt-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 28px;
        }
        .rg-item {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .rg-item:nth-last-child(-n+2) { border-bottom: none; }
        .rg-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: #666;
            font-weight: 600;
            margin-bottom: 4px;
            font-family: 'Inter', sans-serif;
        }
        .rg-value {
            font-size: 14px;
            color: #e0e0e0;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
        }
        .rg-value.highlight { color: var(--secondary); font-size: 16px; }
        .rg-value.paid      { color: #2ecc71; }

        /* Membership active pill */
        .active-pill {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(46,204,113,0.12);
            border: 1px solid rgba(46,204,113,0.3);
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 700;
            color: #2ecc71;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Action buttons */
        .action-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .btn-pdf {
            flex: 1;
            min-width: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 24px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(138,43,226,0.35);
        }
        .btn-pdf:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(138,43,226,0.55);
        }
        .btn-home {
            flex: 1;
            min-width: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 16px 20px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.12);
            color: #aaa;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-home:hover { background: rgba(255,255,255,0.1); color: white; }

        /* Auto-redirect bar */
        .redirect-bar {
            margin-top: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #555;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
        }
        .redirect-bar strong { color: white; }
        .progress-bar-wrap {
            margin-top: 10px;
            height: 3px;
            background: rgba(255,255,255,0.08);
            border-radius: 2px;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
            width: 0%;
            transition: width linear;
        }
    </style>
</head>
<body>

<div class="success-container">

    <!-- Bouncing dots -->
    <div class="confetti-row">
        <div class="confetti-dot"></div>
        <div class="confetti-dot"></div>
        <div class="confetti-dot"></div>
        <div class="confetti-dot"></div>
        <div class="confetti-dot"></div>
    </div>

    <div class="success-card">

        <!-- Header -->
        <div class="success-header">
            <div class="check-ring">
                <i class="ph-fill ph-check-circle"></i>
            </div>
            <h1 class="success-title">Payment Successful!</h1>
            <p class="success-sub">
                Your membership is now <span style="color:#2ecc71;font-weight:700;">ACTIVE</span>.
                Welcome to <?= h($receipt['packageName'] ?? 'Anytime Fitness') ?>!
            </p>
        </div>

        <!-- Receipt body -->
        <div class="receipt-body">

            <!-- Transaction ID -->
            <div class="txn-badge">
                <i class="ph ph-receipt"></i>
                <?= h($receipt['transactionId'] ?? 'TXN-SUCCESS') ?>
            </div>

            <!-- Receipt grid -->
            <div class="receipt-grid">
                <div class="rg-item">
                    <div class="rg-label">Member Name</div>
                    <div class="rg-value"><?= h($receipt['fullName'] ?? '—') ?></div>
                </div>
                <div class="rg-item">
                    <div class="rg-label">Email</div>
                    <div class="rg-value"><?= h($receipt['email'] ?? '—') ?></div>
                </div>
                <div class="rg-item">
                    <div class="rg-label">Package</div>
                    <div class="rg-value"><?= h($receipt['packageName'] ?? '—') ?></div>
                </div>
                <div class="rg-item">
                    <div class="rg-label">Billing Cycle</div>
                    <div class="rg-value"><?= h(ucfirst($receipt['billing'] ?? 'Monthly')) ?></div>
                </div>
                <div class="rg-item">
                    <div class="rg-label">Valid From</div>
                    <div class="rg-value"><?= h($receipt['startDate'] ?? '—') ?></div>
                </div>
                <div class="rg-item">
                    <div class="rg-label">Valid Until</div>
                    <div class="rg-value highlight"><?= h($receipt['endDate'] ?? '—') ?></div>
                </div>
                <div class="rg-item">
                    <div class="rg-label">Payment Method</div>
                    <div class="rg-value"><?= h($receipt['paymentMethod'] ?? '—') ?></div>
                </div>
                <div class="rg-item">
                    <div class="rg-label">Status</div>
                    <div class="rg-value">
                        <span class="active-pill">
                            <i class="ph-fill ph-check-circle"></i> <?= h($receipt['paymentStatus'] ?? 'PAID') ?>
                        </span>
                    </div>
                </div>
                <div class="rg-item" style="grid-column: 1 / -1; background: rgba(138,43,226,0.06); border-top: 1px solid rgba(138,43,226,0.15);">
                    <div class="rg-label">Amount Paid</div>
                    <div class="rg-value paid" style="font-size: 22px; font-family: 'Outfit', sans-serif;">
                        RM <?= h(number_format((float)($receipt['price'] ?? 0), 2)) ?>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="action-row">
                <a href="<?= $this->Url->build('/checkout/invoice') ?>"
                   target="_blank"
                   class="btn-pdf"
                   id="pdfBtn">
                    <i class="ph ph-file-pdf" style="font-size:20px;"></i>
                    Download PDF Receipt
                </a>
                <a href="/" class="btn-home" id="homeBtn">
                    <i class="ph ph-house"></i> Go to Home
                </a>
            </div>

            <!-- Auto-redirect countdown -->
            <div class="redirect-bar">
                <i class="ph ph-arrow-circle-right" style="color: var(--primary);"></i>
                Redirecting to home in <strong id="countdown">8</strong> seconds…
            </div>
            <div class="progress-bar-wrap">
                <div class="progress-bar-fill" id="progressBar"></div>
            </div>

        </div>
    </div>
</div>

<script>
    const TOTAL = 8; // seconds before redirect
    let remaining = TOTAL;
    const countEl = document.getElementById('countdown');
    const barEl   = document.getElementById('progressBar');

    // Start progress bar
    barEl.style.transition = 'width ' + TOTAL + 's linear';
    requestAnimationFrame(() => {
        requestAnimationFrame(() => { barEl.style.width = '100%'; });
    });

    const timer = setInterval(function () {
        remaining--;
        if (countEl) countEl.textContent = remaining;
        if (remaining <= 0) {
            clearInterval(timer);
            window.location.href = '/';
        }
    }, 1000);

    // Cancel countdown if user clicks PDF button
    document.getElementById('pdfBtn').addEventListener('click', function () {
        clearInterval(timer);
        if (countEl) countEl.parentElement.innerHTML = '<span style="color:#555;font-size:13px;">Countdown paused — take your time.</span>';
    });
</script>

</body>
</html>
