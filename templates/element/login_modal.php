<?php
/**
 * Login Modal Element
 *
 * Include this element in any page that needs a login popup.
 * Call openLoginModal() in JavaScript to open it.
 *
 * The form submits to /users/login (POST). CakePHP will handle auth and
 * redirect. If there is a flash error, the page will reload with
 * ?login=1 so this modal re-opens automatically.
 */
?>

<!-- ===================== LOGIN MODAL ===================== -->
<div id="loginModalOverlay" class="lm-overlay" role="dialog" aria-modal="true" aria-labelledby="lmTitle">
    <div class="lm-card" id="loginModalCard">

        <!-- Close button -->
        <button class="lm-close" id="lmCloseBtn" aria-label="Close login modal" onclick="closeLoginModal()">
            <i class="ph ph-x"></i>
        </button>

        <!-- Branding -->
        <div class="lm-brand">
            <span class="lm-brand-icon"><i class="ph-fill ph-barbell"></i></span>
            <span>Anytime<span class="lm-accent">Fitness</span></span>
        </div>

        <h2 id="lmTitle" class="lm-heading">Welcome Back</h2>
        <p class="lm-subheading">Sign in to your account to continue</p>

        <!-- Flash messages area (login errors only) -->
        <?= $this->Flash->render('login') ?>

        <!-- Login Form — posts to same login endpoint -->
        <?= $this->Form->create(null, [
            'url'   => ['controller' => 'Users', 'action' => 'login'],
            'id'    => 'loginModalForm',
            'class' => 'lm-form',
        ]) ?>

        <div class="lm-field">
            <label class="lm-label" for="lm-username">
                <i class="ph ph-user"></i> Username
            </label>
            <?= $this->Form->control('Username', [
                'label'        => false,
                'id'           => 'lm-username',
                'class'        => 'lm-input',
                'required'     => true,
                'placeholder'  => 'Enter your username',
                'autocomplete' => 'username',
            ]) ?>
        </div>

        <div class="lm-field">
            <label class="lm-label" for="lm-password">
                <i class="ph ph-lock"></i> Password
            </label>
            <div class="lm-password-wrap">
                <?= $this->Form->control('Password', [
                    'type'         => 'password',
                    'label'        => false,
                    'id'           => 'lm-password',
                    'class'        => 'lm-input',
                    'required'     => true,
                    'placeholder'  => 'Enter your password',
                    'autocomplete' => 'current-password',
                ]) ?>
                <button type="button" class="lm-eye" onclick="toggleLmPassword()" aria-label="Toggle password visibility">
                    <i class="ph ph-eye" id="lmEyeIcon"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="lm-btn-submit" id="lmSubmitBtn">
            <span class="lm-btn-text"><i class="ph ph-sign-in"></i> Sign In Securely</span>
            <span class="lm-btn-loader" style="display:none;"><i class="ph ph-circle-notch lm-spin"></i> Signing in…</span>
        </button>

        <?= $this->Form->end() ?>

        <p class="lm-footer-text">
            Don't have an account?
            <a href="<?= $this->Url->build('/users/register') ?>" class="lm-link">Join Now &rarr;</a>
        </p>
    </div>
</div>
<!-- =================== END LOGIN MODAL =================== -->


<style>
/* ─── Login Modal Styles ─────────────────────────────────────────── */
.lm-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: rgba(0, 0, 0, 0.75);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.35s ease, visibility 0.35s ease;
}
.lm-overlay.lm-open {
    opacity: 1;
    visibility: visible;
}

.lm-card {
    position: relative;
    background: linear-gradient(160deg, rgba(20,10,40,0.98) 0%, rgba(9,9,11,0.99) 100%);
    border: 1px solid rgba(138,43,226,0.35);
    border-radius: 28px;
    padding: 48px 44px 40px;
    width: 100%;
    max-width: 460px;
    box-shadow:
        0 0 0 1px rgba(255,255,255,0.04),
        0 30px 80px rgba(0,0,0,0.7),
        0 0 60px rgba(138,43,226,0.12);
    transform: translateY(30px) scale(0.96);
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.lm-overlay.lm-open .lm-card {
    transform: translateY(0) scale(1);
}

/* Close button */
.lm-close {
    position: absolute;
    top: 18px;
    right: 18px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #aaa;
    font-size: 18px;
    transition: all 0.2s ease;
}
.lm-close:hover {
    background: rgba(138,43,226,0.2);
    border-color: rgba(138,43,226,0.5);
    color: white;
    transform: rotate(90deg);
}

/* Branding */
.lm-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 28px;
    font-family: 'Outfit', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: white;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.lm-brand-icon {
    font-size: 26px;
    color: var(--primary, #8a2be2);
}
.lm-accent { color: var(--primary, #8a2be2); }

/* Headings */
.lm-heading {
    font-family: 'Outfit', sans-serif;
    font-size: 30px;
    font-weight: 700;
    color: white;
    margin: 0 0 8px;
}
.lm-subheading {
    color: #888;
    font-size: 14px;
    margin: 0 0 28px;
    font-family: 'Inter', sans-serif;
}

/* Form fields */
.lm-form { width: 100%; }
.lm-field { margin-bottom: 20px; }
.lm-label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 600;
    color: #aaa;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
}
.lm-label i { color: var(--primary, #8a2be2); font-size: 15px; }

/* Override CakePHP input wrapper */
.lm-field .input { margin: 0; }

.lm-input,
.lm-field input[type="text"],
.lm-field input[type="password"] {
    width: 100%;
    padding: 14px 16px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 14px;
    color: white;
    font-size: 15px;
    font-family: 'Inter', sans-serif;
    transition: all 0.3s ease;
    box-sizing: border-box;
    outline: none;
}
.lm-field input[type="text"]:focus,
.lm-field input[type="password"]:focus {
    border-color: var(--primary, #8a2be2);
    background: rgba(138,43,226,0.08);
    box-shadow: 0 0 0 3px rgba(138,43,226,0.18);
}
.lm-field input::placeholder { color: #555; }

/* Password wrapper */
.lm-password-wrap { position: relative; }
.lm-password-wrap input {
    width: 100%;
    padding-right: 50px;
    box-sizing: border-box;
}
.lm-eye {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #666;
    font-size: 18px;
    cursor: pointer;
    display: flex;
    align-items: center;
    padding: 4px;
    transition: color 0.2s ease;
}
.lm-eye:hover { color: var(--primary, #8a2be2); }

/* Submit button */
.lm-btn-submit {
    width: 100%;
    padding: 16px;
    margin-top: 10px;
    background: linear-gradient(135deg, var(--primary, #8a2be2), var(--secondary, #00d2ff));
    color: white;
    border: none;
    border-radius: 14px;
    font-size: 16px;
    font-weight: 700;
    font-family: 'Outfit', sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 6px 20px rgba(138,43,226,0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.lm-btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(138,43,226,0.55);
}
.lm-btn-submit:active { transform: translateY(0); }

/* Spinner animation */
@keyframes lm-spin {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}
.lm-spin { display: inline-block; animation: lm-spin 0.8s linear infinite; }

/* Footer text */
.lm-footer-text {
    text-align: center;
    margin-top: 22px;
    font-size: 14px;
    color: #666;
    font-family: 'Inter', sans-serif;
}
.lm-link {
    color: var(--primary, #8a2be2);
    font-weight: 600;
    text-decoration: none;
    transition: color 0.2s ease;
}
.lm-link:hover { color: var(--secondary, #00d2ff); }

/* Flash messages inside modal */
.lm-card .message,
.lm-card .error-message {
    background: rgba(231,76,60,0.12);
    border: 1px solid rgba(231,76,60,0.35);
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 14px;
    color: #e74c3c;
    margin-bottom: 20px;
}

/* Decorative glow */
.lm-card::before {
    content: '';
    position: absolute;
    top: -1px; left: -1px; right: -1px; bottom: -1px;
    border-radius: 28px;
    background: linear-gradient(135deg, rgba(138,43,226,0.3), transparent 60%);
    pointer-events: none;
    z-index: -1;
}

/* Responsive */
@media (max-width: 520px) {
    .lm-card { padding: 36px 24px 30px; }
    .lm-heading { font-size: 24px; }
}
</style>


<script>
(function () {
    /* ── Core open / close ────────────────────────────── */
    function openLoginModal() {
        var overlay = document.getElementById('loginModalOverlay');
        overlay.classList.add('lm-open');
        document.body.style.overflow = 'hidden';
        setTimeout(function () {
            var inp = document.getElementById('lm-username');
            if (inp) inp.focus();
        }, 350);
    }

    function closeLoginModal() {
        var overlay = document.getElementById('loginModalOverlay');
        overlay.classList.remove('lm-open');
        document.body.style.overflow = '';
    }

    window.openLoginModal  = openLoginModal;
    window.closeLoginModal = closeLoginModal;

    /* ── Close on backdrop click ──────────────────────── */
    document.getElementById('loginModalOverlay').addEventListener('click', function (e) {
        if (e.target === this) closeLoginModal();
    });

    /* ── Close on Escape key ──────────────────────────── */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLoginModal();
    });

    /* ── Loading state on submit ──────────────────────── */
    document.getElementById('loginModalForm').addEventListener('submit', function () {
        var btn    = document.getElementById('lmSubmitBtn');
        var text   = btn.querySelector('.lm-btn-text');
        var loader = btn.querySelector('.lm-btn-loader');
        text.style.display   = 'none';
        loader.style.display = 'inline-flex';
        btn.disabled = true;
    });

    /* ── Toggle password visibility ───────────────────── */
    window.toggleLmPassword = function () {
        var inp  = document.getElementById('lm-password');
        var icon = document.getElementById('lmEyeIcon');
        if (inp.type === 'password') {
            inp.type = 'text';
            icon.className = 'ph ph-eye-slash';
        } else {
            inp.type = 'password';
            icon.className = 'ph ph-eye';
        }
    };

    /* ── Auto-open if URL has ?login=1 ────────────────── */
    if (window.location.search.indexOf('login=1') !== -1) {
        openLoginModal();
    }
})();
</script>
