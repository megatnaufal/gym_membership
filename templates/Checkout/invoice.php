<?php $this->disableAutoLayout(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receipt #<?= h($receipt['transactionId'] ?? 'INV') ?> – Anytime Fitness</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        /* ── SCREEN styles ───────────────────────────────────────────── */
        :root {
            --purple: #8a2be2;
            --cyan:   #00d2ff;
            --green:  #2ecc71;
            --dark:   #0d0d0f;
            --text:   #1e293b;
            --muted:  #64748b;
            --border: #e2e8f0;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 20px 60px;
            color: var(--text);
        }

        /* Action toolbar (hidden on print) */
        .toolbar {
            width: 100%;
            max-width: 820px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 12px;
            flex-wrap: wrap;
        }
        .toolbar-left { display: flex; gap: 10px; flex-wrap: wrap; }

        .btn-tool {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 20px;
            border-radius: 9px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s ease;
        }
        .btn-print {
            background: linear-gradient(135deg, var(--purple), var(--cyan));
            color: white;
            box-shadow: 0 4px 15px rgba(138,43,226,0.35);
        }
        .btn-print:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(138,43,226,0.5); }
        .btn-back  {
            background: rgba(255,255,255,0.08);
            color: #ccc;
            border: 1px solid rgba(255,255,255,0.15);
        }
        .btn-back:hover { background: rgba(255,255,255,0.14); color: white; }
        .btn-home {
            background: rgba(46,204,113,0.12);
            color: #2ecc71;
            border: 1px solid rgba(46,204,113,0.3);
        }
        .btn-home:hover { background: rgba(46,204,113,0.2); }

        /* ── Invoice card ──────────────────────────────────────────── */
        .invoice-paper {
            background: white;
            width: 100%;
            max-width: 820px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
            position: relative;
        }

        /* Colour strip at top */
        .invoice-strip {
            height: 8px;
            background: linear-gradient(90deg, var(--purple), var(--cyan));
        }

        .invoice-inner { padding: 50px 54px 44px; }

        /* ── Header ── */
        .inv-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 36px;
            padding-bottom: 28px;
            border-bottom: 2px solid var(--border);
        }

        .brand h1 {
            font-size: 28px;
            font-weight: 900;
            color: var(--text);
            letter-spacing: -0.5px;
        }
        .brand h1 span { color: var(--purple); }
        .brand-sub {
            margin-top: 6px;
            font-size: 12px;
            color: var(--muted);
            line-height: 1.55;
        }

        .inv-meta { text-align: right; }
        .inv-meta .inv-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--muted);
            margin-bottom: 4px;
        }
        .inv-meta h2 {
            font-size: 20px;
            font-weight: 800;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .inv-meta-rows { margin-top: 10px; font-size: 13px; color: var(--muted); line-height: 1.7; }
        .inv-meta-rows strong { color: var(--text); }

        /* PAID watermark */
        .paid-stamp {
            position: absolute;
            top: 52px;
            right: 54px;
            border: 3px solid var(--green);
            color: var(--green);
            font-size: 18px;
            font-weight: 900;
            padding: 5px 16px;
            border-radius: 6px;
            letter-spacing: 3px;
            transform: rotate(-6deg);
            opacity: 0.75;
            pointer-events: none;
        }

        /* ── Info blocks ── */
        .info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 32px;
        }
        .info-block {
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 10px;
            padding: 18px 22px;
        }
        .info-block .ib-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: var(--muted);
            font-weight: 700;
            margin-bottom: 8px;
        }
        .info-block p { font-size: 14px; color: var(--text); font-weight: 700; line-height: 1.5; }
        .info-block span { display: block; font-size: 13px; color: var(--muted); font-weight: 400; }
        .status-ok { color: var(--green) !important; font-weight: 800 !important; }

        /* ── Line items table ── */
        .inv-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 28px;
            font-size: 14px;
        }
        .inv-table thead tr {
            background: #f1f5f9;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }
        .inv-table th {
            padding: 12px 16px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--muted);
            font-weight: 700;
        }
        .inv-table th:last-child, .inv-table td:last-child { text-align: right; }
        .inv-table td {
            padding: 18px 16px;
            color: var(--text);
            border-bottom: 1px solid #f1f5f9;
        }
        .inv-table .item-desc strong { display: block; font-size: 15px; color: var(--text); }
        .inv-table .item-desc span { font-size: 12px; color: var(--muted); margin-top: 3px; display: block; }

        /* ── Totals ── */
        .totals-wrap {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 36px;
        }
        .totals {
            width: 300px;
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 11px 18px;
            font-size: 13px;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
        }
        .total-row:last-child { border-bottom: none; }
        .total-row.grand {
            background: #f8fafc;
            font-weight: 800;
            font-size: 16px;
            color: var(--purple);
        }

        /* ── Validity badge ── */
        .validity-badge {
            background: rgba(46,204,113,0.08);
            border: 1px solid rgba(46,204,113,0.25);
            border-radius: 10px;
            padding: 16px 22px;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 32px;
        }
        .validity-badge i { font-size: 28px; color: var(--green); }
        .validity-badge .vb-label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.7px; color: var(--muted); }
        .validity-badge .vb-val { font-size: 14px; font-weight: 700; color: var(--text); margin-top: 2px; }

        /* ── Footer ── */
        .inv-footer {
            border-top: 1px dashed var(--border);
            padding-top: 22px;
            text-align: center;
            font-size: 11px;
            color: var(--muted);
            line-height: 1.7;
        }
        .inv-footer .footer-brand {
            font-size: 13px;
            font-weight: 700;
            color: var(--purple);
            margin-bottom: 4px;
        }

        /* ═══ PRINT STYLES ═══════════════════════════════════════════ */
        @media print {
            @page {
                size: A4;
                margin: 15mm 12mm;
            }
            html, body {
                background: white !important;
                padding: 0 !important;
            }
            .toolbar { display: none !important; }
            .invoice-paper {
                box-shadow: none !important;
                border-radius: 0 !important;
                max-width: 100% !important;
            }
            .invoice-inner { padding: 0 !important; }
            .invoice-strip { display: block !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .info-block, .totals, .total-row.grand, .validity-badge {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .paid-stamp {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <!-- Toolbar (hidden on print) -->
    <div class="toolbar">
        <div class="toolbar-left">
            <button onclick="window.print()" class="btn-tool btn-print">
                <i class="ph ph-printer"></i> Print / Save PDF
            </button>
            <a href="<?= $this->Url->build('/checkout/thank-you') ?>" class="btn-tool btn-back">
                <i class="ph ph-arrow-left"></i> Back to Summary
            </a>
        </div>
        <a href="/" class="btn-tool btn-home">
            <i class="ph ph-house"></i> Go Home
        </a>
    </div>

    <!-- Invoice Paper -->
    <div class="invoice-paper">

        <!-- Top colour strip -->
        <div class="invoice-strip"></div>

        <div class="invoice-inner">

            <!-- PAID stamp -->
            <div class="paid-stamp">✓ PAID</div>

            <!-- Header -->
            <div class="inv-header">
                <div class="brand">
                    <h1>Anytime<span>Fitness</span></h1>
                    <div class="brand-sub">
                        Anytime Fitness Malaysia Sdn. Bhd.<br>
                        SSM Reg: 202601009988-X &nbsp;|&nbsp; SST: W10-1808-32000050<br>
                        Level 12, Fitness Hub Tower, Kuala Lumpur, Malaysia<br>
                        billing@anytimefitness.com.my &nbsp;|&nbsp; +60 3-8800 9999
                    </div>
                </div>

                <div class="inv-meta">
                    <div class="inv-label">Official Tax Receipt</div>
                    <h2>Invoice</h2>
                    <div class="inv-meta-rows">
                        <strong>Invoice #:</strong> <?= h($receipt['transactionId'] ?? 'TXN-000') ?><br>
                        <strong>Date Issued:</strong> <?= h($receipt['created'] ?? date('d M Y')) ?><br>
                        <strong>Payment Terms:</strong> Immediate Access
                    </div>
                </div>
            </div>

            <!-- Billed To + Payment Info -->
            <div class="info-row">
                <div class="info-block">
                    <div class="ib-label">Billed To</div>
                    <p><?= h($receipt['fullName'] ?? 'Valued Member') ?></p>
                    <span><?= h($receipt['email'] ?? '') ?></span>
                    <span>Phone: <?= h($receipt['phone'] ?? 'N/A') ?></span>
                </div>
                <div class="info-block">
                    <div class="ib-label">Payment Details</div>
                    <p><?= h($receipt['paymentMethod'] ?? 'Stripe Secure Card') ?></p>
                    <span>Status: <span class="status-ok">COMPLETED</span></span>
                    <span>Ref: <?= h($receipt['transactionId'] ?? '—') ?></span>
                </div>
            </div>

            <!-- Membership validity badge -->
            <div class="validity-badge">
                <i class="ph-fill ph-shield-check"></i>
                <div>
                    <div class="vb-label">Membership Validity Period</div>
                    <div class="vb-val">
                        <?= h($receipt['startDate'] ?? '—') ?> &nbsp;→&nbsp; <?= h($receipt['endDate'] ?? '—') ?>
                        &nbsp;·&nbsp; <?= h(ucfirst($receipt['billing'] ?? 'Monthly')) ?> Billing
                    </div>
                </div>
            </div>

            <!-- Line items -->
            <table class="inv-table">
                <thead>
                    <tr>
                        <th style="width:45%;">Description</th>
                        <th>Billing</th>
                        <th>Period</th>
                        <th>Amount (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="item-desc">
                            <strong><?= h($receipt['packageName'] ?? 'Gym Membership') ?></strong>
                            <span>Full 24/7 Gym Access &amp; Member Benefits Included</span>
                        </td>
                        <td><?= h(ucfirst($receipt['billing'] ?? 'Monthly')) ?></td>
                        <td style="font-size:12px;"><?= h($receipt['startDate']) ?> –<br><?= h($receipt['endDate']) ?></td>
                        <td><?= h(number_format((float)($receipt['price'] ?? 0), 2)) ?></td>
                    </tr>
                </tbody>
            </table>

            <!-- Totals -->
            <div class="totals-wrap">
                <div class="totals">
                    <div class="total-row">
                        <span>Subtotal</span>
                        <span>RM <?= h(number_format((float)($receipt['price'] ?? 0), 2)) ?></span>
                    </div>
                    <div class="total-row">
                        <span>Service Tax (SST)</span>
                        <span>RM 0.00</span>
                    </div>
                    <div class="total-row">
                        <span>Discount</span>
                        <span>RM 0.00</span>
                    </div>
                    <div class="total-row grand">
                        <span>TOTAL PAID</span>
                        <span>RM <?= h(number_format((float)($receipt['price'] ?? 0), 2)) ?></span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="inv-footer">
                <div class="footer-brand">Anytime Fitness Malaysia</div>
                This is a computer-generated receipt and is valid without a physical signature.<br>
                For billing enquiries, contact <strong>billing@anytimefitness.com.my</strong> or call <strong>+60 3-8800 9999</strong>.<br>
                Thank you for choosing Anytime Fitness — we're with you every rep of the way! 💪
            </div>

        </div>
    </div>

    <script>
        // Auto-trigger print dialog after a short delay so the page renders fully
        window.addEventListener('load', function () {
            setTimeout(function () {
                window.print();
            }, 800);
        });
    </script>

</body>
</html>
