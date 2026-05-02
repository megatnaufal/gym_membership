<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password - Anytime Fitness</title>
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            background: var(--bg-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: white;
            margin: 0;
            font-family: 'Inter', sans-serif;
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
            box-sizing: border-box;
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
            transition: background 0.3s ease;
        }
        .btn-login:hover {
            background: var(--primary-hover);
        }
        /* Flash messages */
        .message {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-weight: 600;
            text-align: center;
        }
        .message.success { background: rgba(46, 204, 113, 0.2); color: #2ecc71; border: 1px solid #2ecc71; }
        .message.error { background: rgba(231, 76, 60, 0.2); color: #e74c3c; border: 1px solid #e74c3c; }
    </style>
</head>
<body>
    <div class="login-card">
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="/" style="font-size: 24px; font-weight: bold; color: white; text-decoration: none;">Anytime<span style="color: var(--primary);">Fitness</span></a>
        </div>
        
        <h2>Change Password</h2>
        
        <?= $this->Flash->render() ?>
        
        <?= $this->Form->create() ?>
        <div class="form-group">
            <label>Current Password</label>
            <?= $this->Form->control('current_password', ['type' => 'password', 'label' => false, 'required' => true]) ?>
        </div>
        <div class="form-group">
            <label>New Password</label>
            <?= $this->Form->control('new_password', ['type' => 'password', 'label' => false, 'required' => true]) ?>
        </div>
        <div class="form-group">
            <label>Confirm New Password</label>
            <?= $this->Form->control('confirm_password', ['type' => 'password', 'label' => false, 'required' => true]) ?>
        </div>
        
        <button type="submit" class="btn-login"><i class="ph ph-lock-key"></i> Update Password</button>
        <?= $this->Form->end() ?>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="javascript:history.back()" style="color: #aaa; text-decoration: none; font-size: 14px;"><i class="ph ph-arrow-left"></i> Go Back</a>
        </div>
    </div>
</body>
</html>
