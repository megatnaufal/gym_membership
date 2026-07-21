<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account - Anytime Fitness</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <?= $this->Html->css(['anytime_home']) ?>
    <style>
        body {
            background: var(--bg-dark);
            background-image: radial-gradient(circle at top right, rgba(138,43,226,0.15) 0%, transparent 40%),
                              radial-gradient(circle at bottom left, rgba(0,210,255,0.1) 0%, transparent 40%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: white;
            font-family: 'Inter', sans-serif;
        }
        .register-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 50px 40px;
            width: 100%;
            max-width: 500px;
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow: var(--glass-shadow);
            margin: 40px 0;
        }
        .register-card h2 {
            margin-bottom: 30px;
            text-align: center;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 32px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #aaa; font-size: 14px; }
        .form-group input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: white;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255,255,255,0.08);
            box-shadow: 0 0 0 3px rgba(138,43,226,0.2);
        }
        .btn-register {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            font-family: 'Outfit', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            margin-top: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(138,43,226,0.3);
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(138,43,226,0.5);
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="/" style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 800; color: white; text-decoration: none; text-transform: uppercase; letter-spacing: 1px;">Anytime<span style="color: var(--primary);">Fitness</span></a>
        </div>
        
        <h2>Create Account</h2>
        
        <?= $this->Flash->render() ?>
        
        <?= $this->Form->create($user) ?>
        
        <div class="form-group">
            <label>Full Name</label>
            <?= $this->Form->control('FullName', ['label' => false, 'required' => true, 'placeholder' => 'John Doe']) ?>
        </div>
        
        <div class="form-group">
            <label>Email Address</label>
            <?= $this->Form->control('Email', ['label' => false, 'required' => true, 'type' => 'email', 'placeholder' => 'john@example.com']) ?>
        </div>
        
        <div class="form-group">
            <label>Phone Number (Optional)</label>
            <?= $this->Form->control('Phone', ['label' => false, 'placeholder' => '01X-XXXXXXX', 'maxlength' => 11]) ?>
        </div>
        
        <div class="form-group">
            <label>Username</label>
            <?= $this->Form->control('Username', ['label' => false, 'required' => true, 'placeholder' => 'Choose a username']) ?>
        </div>
        
        <div class="form-group">
            <label>Password</label>
            <?= $this->Form->control('Password', ['type' => 'password', 'label' => false, 'required' => true, 'minlength' => 8, 'placeholder' => 'Create a strong password']) ?>
        </div>
        
        <button type="submit" class="btn-register">Sign Up Now</button>
        <?= $this->Form->end() ?>
        
        <p style="text-align: center; margin-top: 20px; font-size: 14px; color: #aaa;">
            Already have an account? <a href="<?= $this->Url->build('/?login=1') ?>" style="color: var(--primary);">Sign In</a>
        </p>
    </div>
</body>
</html>
