<?php $this->disableAutoLayout(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout – <?= h($package->PackageName) ?> | Anytime Fitness</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        /* ── Layout ── */
        * { box-sizing: border-box; }
        body { margin: 0; background: var(--bg-dark); font-family: 'Inter', sans-serif; }

        .ck-wrap {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .ck-side {
            width: 38%;
            background: linear-gradient(160deg, #120a22 0%, #0d0d0f 100%);
            border-right: 1px solid rgba(255,255,255,0.06);
            padding: 52px 50px;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
        }
        .ck-side .brand a {
            font-family: 'Outfit', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: white;
            text-decoration: none;
        }
        .ck-side .brand a span { color: var(--primary); }

        .pkg-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 32px;
            margin-top: 36px;
            flex: 1;
        }
        .pkg-name {
            font-family: 'Outfit', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin: 0 0 6px;
        }
        .pkg-cycle { color: #777; font-size: 13px; margin-bottom: 24px; }
        .pkg-price {
            font-family: 'Outfit', sans-serif;
            font-size: 48px;
            font-weight: 800;
            color: white;
            margin-bottom: 6px;
        }
        .pkg-price span { font-size: 22px; color: var(--primary); font-weight: 700; }
        .pkg-divider { height: 1px; background: rgba(255,255,255,0.07); margin: 22px 0; }
        .pkg-feature {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ccc;
            font-size: 14px;
            margin-bottom: 12px;
        }
        .pkg-feature i { color: #2ecc71; font-size: 17px; flex-shrink: 0; }
        .ssl-note {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555;
            font-size: 12px;
            margin-top: auto;
            padding-top: 24px;
        }
        .ssl-note i { color: #2ecc71; font-size: 18px; }

        /* Main form area */
        .ck-main {
            flex: 1;
            padding: 52px 64px 80px;
            overflow-y: auto;
        }

        /* Flash messages */
        .flash-err {
            background: rgba(231,76,60,0.12);
            border: 1px solid rgba(231,76,60,0.35);
            border-radius: 12px;
            padding: 14px 18px;
            color: #ff6b6b;
            font-size: 14px;
            margin-bottom: 24px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        /* Section headers */
        .ck-heading {
            font-family: 'Outfit', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin: 0 0 6px;
        }
        .ck-sub { color: #666; font-size: 14px; margin-bottom: 32px; }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(138,43,226,0.1);
            border: 1px solid rgba(138,43,226,0.3);
            border-radius: 14px;
            padding: 14px 18px;
            margin-bottom: 28px;
        }
        .user-badge i { font-size: 34px; color: var(--primary); }
        .user-badge .ub-name { color: white; font-weight: 700; font-size: 15px; }
        .user-badge .ub-email { color: #888; font-size: 13px; }
        .user-badge .ub-pill {
            margin-left: auto;
            background: var(--primary);
            color: white;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* Section labels */
        .sec-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #555;
            font-weight: 700;
            margin: 28px 0 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sec-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.06);
        }

        /* Input fields */
        .frow { display: flex; gap: 16px; margin-bottom: 16px; }
        .fgroup { flex: 1; display: flex; flex-direction: column; }
        .fgroup.mb { margin-bottom: 16px; }

        label.flabel {
            font-size: 13px;
            color: #888;
            margin-bottom: 7px;
            display: block;
        }
        label.flabel span { color: #e74c3c; margin-left: 2px; }

        input.finput, select.finput {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            color: white;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            appearance: none;
        }
        input.finput::placeholder { color: #444; }
        input.finput:focus, select.finput:focus {
            border-color: var(--primary);
            background: rgba(255,255,255,0.07);
            box-shadow: 0 0 0 3px rgba(138,43,226,0.18);
        }
        input.finput:read-only {
            color: #666;
            cursor: not-allowed;
            background: rgba(255,255,255,0.02);
            border-color: rgba(255,255,255,0.06);
        }
        select.finput option { background: #1a1a1a; color: white; }

        /* Payment method tabs */
        .pm-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }
        .pm-tab {
            flex: 1;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.04);
            color: #aaa;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            user-select: none;
        }
        .pm-tab.active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 4px 14px rgba(138,43,226,0.35);
        }

        /* Card panel */
        .card-panel {
            background: linear-gradient(135deg, #1a1a2e, #0f0f1a);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 24px;
        }
        .card-panel-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
            color: #ccc;
        }
        .encrypted-badge {
            font-size: 12px;
            color: #2ecc71;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .cc-num-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 14px;
        }
        .cc-num-wrap i { color: #888; font-size: 20px; flex-shrink: 0; }
        .cc-num-wrap input {
            background: transparent;
            border: none;
            outline: none;
            color: white;
            font-size: 16px;
            letter-spacing: 3px;
            font-family: 'Courier New', monospace;
            width: 100%;
        }
        .cc-num-wrap input::placeholder { letter-spacing: 1px; color: #444; }

        .cc-row { display: flex; gap: 14px; }
        .cc-half {
            flex: 1;
            background: rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px;
            padding: 12px 16px;
        }
        .cc-half label { display: block; font-size: 11px; color: #666; margin-bottom: 4px; }
        .cc-half input {
            background: transparent;
            border: none;
            outline: none;
            color: white;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            width: 100%;
        }
        .cc-half input::placeholder { color: #444; }

        /* FPX panel */
        .fpx-panel { display: none; }
        .fpx-panel .bank-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .bank-opt {
            padding: 14px 10px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px;
            text-align: center;
            font-size: 13px;
            color: #aaa;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .bank-opt:hover { border-color: var(--primary); color: white; background: rgba(138,43,226,0.08); }
        .bank-opt.selected { border-color: var(--primary); background: rgba(138,43,226,0.15); color: white; font-weight: 700; }

        /* Submit button */
        .btn-pay {
            width: 100%;
            padding: 18px;
            margin-top: 28px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 14px;
            font-family: 'Outfit', sans-serif;
            font-size: 17px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(138,43,226,0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-pay:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(138,43,226,0.55);
        }
        .btn-pay:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        .spin { animation: spin 0.8s linear infinite; }

        .pay-note {
            text-align: center;
            color: #444;
            font-size: 12px;
            margin-top: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .pay-note i { color: #2ecc71; }

        @media (max-width: 900px) {
            .ck-wrap { flex-direction: column; }
            .ck-side { width: 100%; height: auto; position: static; }
            .ck-main { padding: 36px 24px 60px; }
            .frow { flex-direction: column; gap: 0; }
        }
    </style>
</head>
<body>

<div class="ck-wrap">

    <!-- ═══ LEFT SIDEBAR ═══════════════════════════════════════════ -->
    <aside class="ck-side">
        <div class="brand">
            <a href="/"><span style="color:white;">Anytime</span><span>Fitness</span></a>
        </div>

        <div class="pkg-card">
            <p class="pkg-name"><?= h($package->PackageName) ?></p>
            <p class="pkg-cycle">Billed <?= h(strtolower($package->BillingCycle)) ?></p>
            <div class="pkg-price"><span>RM</span><?= h(number_format((float)$package->Price, 2)) ?></div>

            <div class="pkg-divider"></div>

            <div class="pkg-feature"><i class="ph-fill ph-check-circle"></i> Full 24/7 Gym Access</div>
            <div class="pkg-feature"><i class="ph-fill ph-check-circle"></i> 1-on-1 Personal Training Sessions</div>
            <div class="pkg-feature"><i class="ph-fill ph-check-circle"></i> Custom Nutrition Plan</div>
            <div class="pkg-feature"><i class="ph-fill ph-check-circle"></i> Iron-Clad Guarantee (First Session Free)</div>
            <div class="pkg-feature"><i class="ph-fill ph-check-circle"></i> Member-Only Class Bookings</div>
            <div class="pkg-feature"><i class="ph-fill ph-check-circle"></i> Official PDF Receipt & Invoice</div>

            <div class="pkg-divider"></div>

            <div class="pkg-feature" style="color:#888; font-size:13px;">
                <i class="ph ph-calendar" style="color:#888;"></i>
                Valid for <?= strtolower($package->BillingCycle) === 'yearly' ? '12 months' : (strtolower($package->BillingCycle) === 'quarterly' ? '3 months' : '1 month') ?>
                from activation
            </div>
        </div>

        <div class="ssl-note">
            <i class="ph-fill ph-lock-key"></i>
            Secured by 256-bit SSL Encryption
        </div>
    </aside>

    <!-- ═══ MAIN FORM ═══════════════════════════════════════════════ -->
    <main class="ck-main">

        <h1 class="ck-heading">Complete Your Purchase</h1>
        <p class="ck-sub">
            <?= $isLoggedIn ? 'Confirm your details and choose a payment method.' : 'Create your account and activate your membership instantly.' ?>
        </p>

        <!-- Flash errors -->
        <?php if ($this->Flash->render()): ?>
            <?= $this->Flash->render() ?>
        <?php endif; ?>

        <?php
        // Get current user data for pre-filling
        $currentName  = '';
        $currentEmail = '';
        $currentPhone = '';
        if ($isLoggedIn && $sessionUser) {
            $currentName  = is_object($sessionUser) ? ($sessionUser->FullName ?? '') : ($sessionUser['FullName'] ?? '');
            $currentEmail = is_object($sessionUser) ? ($sessionUser->Email ?? '') : ($sessionUser['Email'] ?? '');
            $currentPhone = is_object($sessionUser) ? ($sessionUser->Phone ?? '') : ($sessionUser['Phone'] ?? '');
        }
        ?>

        <form method="POST"
              action="<?= $this->Url->build(['controller' => 'Checkout', 'action' => 'package', $package->PackageID]) ?>"
              id="ckForm"
              onsubmit="return handlePay(this)">

            <input type="hidden" name="payment_method" id="pm_input" value="stripe">
            <input type="hidden" name="fpx_bank" id="fpx_bank_input" value="">

            <?php if ($isLoggedIn): ?>
                <!-- ── Logged-in user badge ── -->
                <div class="user-badge">
                    <i class="ph-fill ph-user-circle"></i>
                    <div>
                        <div class="ub-name"><?= h($currentName) ?></div>
                        <div class="ub-email"><?= h($currentEmail) ?></div>
                    </div>
                    <span class="ub-pill">Logged In</span>
                </div>

                <!-- Allow updating phone -->
                <div class="sec-label">Contact Info</div>
                <div class="frow">
                    <div class="fgroup">
                        <label class="flabel">Full Name</label>
                        <input class="finput" type="text" name="full_name" value="<?= h($currentName) ?>" required>
                    </div>
                    <div class="fgroup">
                        <label class="flabel">Phone Number</label>
                        <input class="finput" type="tel" name="phone" value="<?= h($currentPhone) ?>"
                               placeholder="01X-XXXXXXX" maxlength="11">
                    </div>
                </div>

            <?php else: ?>
                <!-- ── Guest: Full registration ── -->
                <div class="sec-label">Personal Details</div>

                <div class="fgroup mb">
                    <label class="flabel">Full Name <span>*</span></label>
                    <input class="finput" type="text" name="full_name" placeholder="John Doe" required>
                </div>

                <div class="frow">
                    <div class="fgroup">
                        <label class="flabel">Email Address <span>*</span></label>
                        <input class="finput" type="email" name="email" placeholder="john@example.com" required>
                    </div>
                    <div class="fgroup">
                        <label class="flabel">Phone Number</label>
                        <input class="finput" type="tel" name="phone" placeholder="01X-XXXXXXX" maxlength="11">
                    </div>
                </div>

                <div class="sec-label">Create Account</div>

                <div class="frow">
                    <div class="fgroup">
                        <label class="flabel">Username <span>*</span></label>
                        <input class="finput" type="text" name="username" placeholder="Choose a username" required>
                    </div>
                    <div class="fgroup">
                        <label class="flabel">Password <span>*</span></label>
                        <input class="finput" type="password" name="password" placeholder="Min. 8 characters" required minlength="8">
                    </div>
                </div>

            <?php endif; ?>

            <!-- ── Payment Method ── -->
            <div class="sec-label">Payment Method</div>

            <div class="pm-tabs">
                <div class="pm-tab active" id="tab-stripe" onclick="switchPM('stripe')">
                    <i class="ph ph-credit-card"></i> Credit / Debit Card (Stripe)
                </div>
                <div class="pm-tab" id="tab-fpx" onclick="switchPM('fpx')">
                    <i class="ph ph-bank"></i> FPX Online Banking
                </div>
            </div>

            <!-- Stripe Card Panel -->
            <div id="stripe-panel">
                <div class="card-panel">
                    <div class="card-panel-head">
                        <span><i class="ph ph-credit-card" style="margin-right:6px;"></i>Stripe Secure Card</span>
                        <span class="encrypted-badge"><i class="ph-fill ph-shield-check"></i> Encrypted</span>
                    </div>

                    <div style="margin-bottom: 14px;">
                        <label class="flabel" style="margin-bottom:8px;">Card Number</label>
                        <div class="cc-num-wrap">
                            <i class="ph ph-credit-card" id="cc-icon"></i>
                            <input type="text" name="card_number" id="cc-number"
                                   placeholder="4242 4242 4242 4242"
                                   maxlength="19" autocomplete="cc-number"
                                   inputmode="numeric">
                        </div>
                    </div>

                    <div class="cc-row">
                        <div class="cc-half">
                            <label>Expiry Date</label>
                            <input type="text" name="card_expiry" id="cc-expiry" placeholder="MM/YY" maxlength="5">
                        </div>
                        <div class="cc-half">
                            <label>CVC / CVV</label>
                            <input type="text" name="card_cvc" id="cc-cvc" placeholder="123" maxlength="4">
                        </div>
                    </div>
                </div>
            </div>

            <!-- FPX Panel -->
            <div id="fpx-panel" class="fpx-panel">
                <p style="color:#888; font-size:13px; margin-bottom:14px;">Select your bank to continue via FPX Online Banking:</p>
                <div class="bank-grid">
                    <?php foreach (['Maybank2U', 'CIMB Clicks', 'Public Bank', 'RHB Bank', 'Hong Leong', 'AmBank', 'Bank Islam', 'BSN', 'Bank Rakyat'] as $bank): ?>
                        <div class="bank-opt" onclick="selectBank('<?= h($bank) ?>', this)"><?= h($bank) ?></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-pay" id="payBtn">
                <span id="btn-icon"><i class="ph-fill ph-lock-key"></i></span>
                <span id="btn-text">Pay RM <?= h(number_format((float)$package->Price, 2)) ?> &amp; Activate Package</span>
            </button>

            <p class="pay-note">
                <i class="ph-fill ph-shield-check"></i>
                Guaranteed Safe &amp; Secure — Powered by Stripe &amp; FPX
            </p>

        </form>

    </main>
</div>

<script>
    // ── Payment method switching ──────────────────────────────────────
    function switchPM(method) {
        document.getElementById('pm_input').value = method;
        const stripeTab   = document.getElementById('tab-stripe');
        const fpxTab      = document.getElementById('tab-fpx');
        const stripePanel = document.getElementById('stripe-panel');
        const fpxPanel    = document.getElementById('fpx-panel');

        if (method === 'stripe') {
            stripeTab.classList.add('active');
            fpxTab.classList.remove('active');
            stripePanel.style.display = 'block';
            fpxPanel.style.display = 'none';
        } else {
            fpxTab.classList.add('active');
            stripeTab.classList.remove('active');
            fpxPanel.style.display = 'block';
            stripePanel.style.display = 'none';
        }
    }

    // ── FPX bank selection ────────────────────────────────────────────
    function selectBank(name, el) {
        document.querySelectorAll('.bank-opt').forEach(b => b.classList.remove('selected'));
        el.classList.add('selected');
        document.getElementById('fpx_bank_input').value = name;
    }

    // ── Card number formatting ────────────────────────────────────────
    document.getElementById('cc-number').addEventListener('input', function(e) {
        let v = e.target.value.replace(/\D/g, '').slice(0, 16);
        e.target.value = v.replace(/(\d{4})(?=\d)/g, '$1 ');
    });

    // ── Expiry formatting ─────────────────────────────────────────────
    document.getElementById('cc-expiry').addEventListener('input', function(e) {
        let v = e.target.value.replace(/\D/g, '').slice(0, 4);
        if (v.length > 2) v = v.slice(0, 2) + '/' + v.slice(2);
        e.target.value = v;
    });

    // ── CVC: digits only ──────────────────────────────────────────────
    document.getElementById('cc-cvc').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '').slice(0, 4);
    });

    // ── Submit with loading state ─────────────────────────────────────
    function handlePay(form) {
        const pm = document.getElementById('pm_input').value;

        // FPX: bank must be selected
        if (pm === 'fpx' && !document.getElementById('fpx_bank_input').value) {
            alert('Please select a bank to continue.');
            return false;
        }

        // Show loading
        const btn  = document.getElementById('payBtn');
        const icon = document.getElementById('btn-icon');
        const text = document.getElementById('btn-text');
        btn.disabled = true;
        icon.innerHTML = '<i class="ph ph-circle-notch spin"></i>';
        text.textContent = 'Processing Payment…';
        return true;
    }
</script>

</body>
</html>
