<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Package> $packages
 */
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Private Coaching - Anytime Fitness</title>
    
    <?= $this->Html->css(['anytime_home', 'anytime_coaching']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar" style="background: rgba(15, 15, 17, 0.95); position: sticky; z-index: 100;">
        <div class="nav-brand">
            <a href="/">Anytime<span>Fitness</span></a>
        </div>
        <div class="nav-links">
            <a href="<?= $this->Url->build('/our-trainers') ?>">Our Trainers</a>
            <a href="<?= $this->Url->build('/private-coaching') ?>" style="color: var(--primary);">Private Coaching</a>
            <a href="<?= $this->Url->build('/shop') ?>">Shop</a>
            <a href="<?= $this->Url->build('/') ?>">Why Join</a>
        </div>
        <a href="<?= $this->Url->build('/') ?>" class="nav-cta">Join Now</a>
    </nav>

    <!-- Header -->
    <header class="pricing-header">
        <h1>Transform Your Life Today</h1>
        <p>Unlock your ultimate potential with our expert-designed private coaching packages. Secure your spot now and lock in our exclusive online pricing.</p>
    </header>

    <!-- Pricing Grid -->
    <div class="pricing-container">
        
        <?php 
        $i = 0;
        foreach ($packages as $package): 
            $i++;
            // Calculate a fake original price for the psychological effect
            $originalPrice = is_numeric($package->Price) ? intval($package->Price * 1.5) : intval((float)str_replace(',', '', $package->Price) * 1.5);
            $isPopular = ($i == 2); // Make the second package "Popular"
            
            $level = $package->AccessLevel ?? 'Basic';
            $features = [];
            
            if ($level === 'Basic') {
                $features = [
                    '24/7 Global Club Access',
                    'State-of-the-Art Equipment Usage',
                    'Complimentary Fitness Assessment',
                    'Access to Anytime Fitness App',
                    'Locker Room & Premium Showers',
                    'No Lock-in Contract (Cancel Anytime)'
                ];
            } elseif ($level === 'Standard') {
                $features = [
                    'Everything in Basic, PLUS:',
                    'Unlimited Group Classes (HIIT, Yoga, Spin)',
                    'Pre-booking Priority for Classes',
                    'Free Monthly Body Composition Scan',
                    '10% Discount at the Juice Bar',
                    'Free Anytime Fitness Towel'
                ];
            } elseif ($level === 'Premium') {
                $features = [
                    'Everything in Standard, PLUS:',
                    '4x Private 1-on-1 Coaching Sessions',
                    'Personalized Workout Programming',
                    'Form Correction & Technique Analysis',
                    'Direct WhatsApp Support from Trainer',
                    'Custom Caloric & Macro Goal Setting'
                ];
            } elseif ($level === 'VIP') {
                $features = [
                    'Everything in Premium, PLUS:',
                    '8x Private 1-on-1 Coaching Sessions',
                    'Dedicated Permanent Locker',
                    'Comprehensive Bi-Weekly Progress Tracking',
                    'Fully Customized Meal Plan Creation',
                    'Complimentary Protein Shake Post-Workout'
                ];
            } elseif ($level === 'Elite') {
                $features = [
                    'The Ultimate VIP Experience:',
                    '12x Private 1-on-1 Coaching Sessions',
                    '24/7 On-Call Concierge Trainer Support',
                    'Advanced Recovery (Massage Passes)',
                    'Free Anytime Fitness Premium Merch Kit',
                    'Unlimited VIP Guest Passes (Bring a friend)'
                ];
            } else {
                $features = ['24/7 Premium Gym Access', '1-on-1 Strategy Session'];
            }
        ?>
        <div class="pricing-card <?= $isPopular ? 'popular' : '' ?>">
            <?php if ($isPopular): ?>
                <div class="popular-badge">Most Popular / Best Value</div>
            <?php endif; ?>
            
            <div class="plan-name"><?= h($package->PackageName) ?></div>
            <div class="plan-price-container">
                <span class="original-price">RM <?= number_format($originalPrice) ?></span>
                <div class="current-price">
                    <span class="currency">RM</span><?= h($package->Price) ?><span class="billing-cycle">/<?= h($package->BillingCycle) ?></span>
                </div>
            </div>
            <ul class="plan-features">
                <?php foreach ($features as $feature): ?>
                    <li <?= strpos($feature, 'PLUS:') !== false || strpos($feature, 'Experience:') !== false ? 'style="color: var(--primary); font-weight: bold; margin-bottom: 15px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px;"' : '' ?>>
                        <?php if (strpos($feature, 'PLUS:') === false && strpos($feature, 'Experience:') === false): ?>
                            <i class="ph-fill ph-check-circle"></i>
                        <?php endif; ?>
                        <?= $feature ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a href="<?= $this->Url->build(['controller' => 'Checkout', 'action' => 'package', $package->PackageID]) ?>" class="btn btn-primary btn-pricing" <?= !$isPopular ? 'style="background: transparent; border: 2px solid var(--primary);"' : '' ?>>Select Plan</a>
        </div>
        <?php endforeach; ?>

    </div>

    <!-- Guarantee Banner -->
    <div class="guarantee-banner">
        <i class="ph-fill ph-shield-check"></i>
        <div>
            <h4>Iron-Clad Results Guarantee</h4>
            <p>We are so confident in our world-class trainers that if you don't see measurable results in your first 30 days while following the plan, your <strong>First Session is completely FREE</strong>. No questions asked.</p>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="<?= $this->Url->build('/') ?>">Home</a>
            <a href="<?= $this->Url->build('/') ?>">Careers</a>
            <a href="<?= $this->Url->build('/') ?>">Privacy Policy</a>
            <a href="<?= $this->Url->build('/') ?>">Terms & Conditions</a>
        </div>
        <p style="color: #555; font-size: 12px; text-align: center;">© <?= date('Y') ?> Anytime Fitness. All rights reserved.</p>
    </footer>

</body>
</html>
