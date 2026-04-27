<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You - Anytime Fitness</title>
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        .thank-you-wrapper {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-dark);
            text-align: center;
            padding: 20px;
        }
        
        .thank-you-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 60px 40px;
            max-width: 600px;
            backdrop-filter: blur(20px);
        }
        
        .check-circle {
            width: 100px;
            height: 100px;
            background: rgba(46, 204, 113, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
        }
        
        .check-circle i {
            font-size: 50px;
            color: #2ecc71;
        }
        
        h1 {
            font-size: 36px;
            margin-bottom: 15px;
            color: white;
        }
        
        p {
            color: #ccc;
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .redirect-text {
            color: #888;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
    </style>
    
    <script>
        // Redirect to homepage after 5 seconds
        setTimeout(function() {
            window.location.href = "<?= $this->Url->build('/') ?>";
        }, 5000);
    </script>
</head>
<body>

<div class="thank-you-wrapper">
    <div class="thank-you-card">
        <div class="check-circle">
            <i class="ph-fill ph-check"></i>
        </div>
        <h1>Welcome to Anytime Fitness!</h1>
        <p>Your payment was successful and your Private Coaching membership is now active. We've sent a receipt and your facility access instructions to your email.</p>
        
        <a href="<?= $this->Url->build('/') ?>" class="btn btn-primary" style="display: inline-block; padding: 12px 30px; margin-bottom: 30px;">Return to Homepage Now</a>
        
        <div class="redirect-text">
            <i class="ph ph-spinner-gap" style="animation: spin 1s linear infinite;"></i>
            You will be automatically redirected to the homepage in a few seconds...
        </div>
    </div>
</div>

<style>
@keyframes spin { 100% { transform: rotate(360deg); } }
</style>

</body>
</html>
