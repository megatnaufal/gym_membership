<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Anytime Fitness</title>
    <?= $this->Html->css(['anytime_home']) ?>
    <style>
        body {
            background: var(--bg-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: white;
        }
        .login-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            backdrop-filter: blur(20px);
        }
        .login-card h2 {
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #aaa; font-size: 14px; }
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            color: white;
        }
        .btn-login {
            width: 100%;
            padding: 15px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="/" style="font-size: 24px; font-weight: bold; color: white; text-decoration: none;">Anytime<span style="color: var(--primary);">Fitness</span></a>
        </div>
        
        <h2>Sign In</h2>
        
        <?= $this->Flash->render() ?>
        
        <?= $this->Form->create(null) ?>
        <div class="form-group">
            <label>Username</label>
            <?= $this->Form->control('Username', ['label' => false, 'required' => true]) ?>
        </div>
        <div class="form-group">
            <label>Password</label>
            <?= $this->Form->control('Password', ['type' => 'password', 'label' => false, 'required' => true]) ?>
        </div>
        
        <button type="submit" class="btn-login">Login Securely</button>
        <?= $this->Form->end() ?>
        
        <p style="text-align: center; margin-top: 20px; font-size: 14px; color: #aaa;">
            Don't have an account? <a href="<?= $this->Url->build('/private-coaching') ?>" style="color: var(--primary);">Join Now</a>
        </p>
    </div>
</body>
</html>
