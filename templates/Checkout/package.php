<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - Anytime Fitness</title>
    <?= $this->Html->css(['anytime_home', 'anytime_checkout']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

<div class="checkout-wrapper">
    <!-- Sidebar / Order Summary -->
    <div class="checkout-sidebar">
        <div class="nav-brand" style="margin-bottom: 40px;">
            <a href="/">Anytime<span>Fitness</span></a>
        </div>
        
        <h2 style="color: white; margin-bottom: 10px;">Order Summary</h2>
        <p style="color: #ccc;">You are registering for a private coaching plan. This package automatically grants you full member access.</p>
        
        <div class="order-summary">
            <h3><?= h($package->PackageName) ?></h3>
            <p style="color: #888; font-size: 14px; margin-bottom: 20px;">Billed every <?= h($package->BillingCycle) ?></p>
            
            <div class="order-total">
                <span>RM</span><?= h($package->Price) ?>
            </div>
            
            <ul class="order-features plan-features" style="padding: 0; list-style: none;">
                <li><i class="ph-fill ph-check-circle"></i> 1-on-1 Sessions</li>
                <li><i class="ph-fill ph-check-circle"></i> Custom Nutrition Plan</li>
                <li><i class="ph-fill ph-check-circle"></i> 24/7 Gym Access Included</li>
                <li><i class="ph-fill ph-check-circle"></i> Iron-Clad Guarantee (First Session Free)</li>
            </ul>
        </div>
        
        <div style="margin-top: auto; display: flex; align-items: center; gap: 10px; color: #888; font-size: 12px;">
            <i class="ph-fill ph-lock-key" style="font-size: 24px;"></i>
            Secure 256-bit SSL Encrypted Checkout
        </div>
    </div>
    
    <!-- Main Form Area -->
    <div class="checkout-main">
        <?= $this->Flash->render() ?>
        
        <div class="checkout-form">
            <h2>Complete Your Registration</h2>
            
            <?= $this->Form->create($user, ['class' => 'form']) ?>
            
            <h3 class="section-title">Personal Details</h3>
            <div class="form-group">
                <label>Full Name</label>
                <?= $this->Form->control('FullName', ['label' => false, 'required' => true, 'placeholder' => 'John Doe']) ?>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Email Address</label>
                    <?= $this->Form->control('Email', ['label' => false, 'required' => true, 'placeholder' => 'john@example.com']) ?>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <?= $this->Form->control('Phone', ['label' => false, 'required' => true, 'placeholder' => '+60 12-345 6789']) ?>
                </div>
            </div>
            
            <h3 class="section-title">Account Security</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Username</label>
                    <?= $this->Form->control('Username', ['label' => false, 'required' => true, 'placeholder' => 'johndoe123']) ?>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <?= $this->Form->control('Password', ['type' => 'password', 'label' => false, 'required' => true, 'placeholder' => '••••••••']) ?>
                </div>
            </div>
            
            <h3 class="section-title">Payment Method</h3>
            <!-- Mock Credit Card Input -->
            <div class="mock-cc">
                <div class="cc-logos">
                    <i class="ph-fill ph-credit-card"></i>
                    <span style="font-size: 14px; color: #888; margin-left: auto;">Anytime Pay</span>
                </div>
                
                <label style="color: #ccc; font-size: 12px;">Card Number</label>
                <div class="cc-input-group" style="margin-bottom: 15px;">
                    <i class="ph ph-credit-card" style="color: #888;"></i>
                    <input type="text" placeholder="0000 0000 0000 0000" maxlength="19" style="flex-grow: 1;">
                </div>
                
                <div class="form-row">
                    <div style="flex: 1;">
                        <label style="color: #ccc; font-size: 12px;">Expiry Date</label>
                        <div class="cc-input-group">
                            <input type="text" placeholder="MM/YY" maxlength="5" style="width: 100%;">
                        </div>
                    </div>
                    <div style="flex: 1;">
                        <label style="color: #ccc; font-size: 12px;">CVC</label>
                        <div class="cc-input-group">
                            <input type="password" placeholder="123" maxlength="4" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn-checkout">Complete Registration & Pay RM <?= h($package->Price) ?></button>
            <p style="text-align: center; color: #888; font-size: 12px; margin-top: 15px;">By clicking this button, you agree to our Terms of Service and Privacy Policy.</p>
            
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

</body>
</html>
