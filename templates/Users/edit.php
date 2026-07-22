<?php
$this->disableAutoLayout();
$sessionUser = $this->request->getSession()->read('Auth.User');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Profile - Anytime Fitness</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        .profile-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 0 20px;
        }
        .profile-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 40px;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.5);
        }
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .profile-header i {
            font-size: 64px;
            color: var(--primary);
            margin-bottom: 10px;
        }
        .profile-header h2 {
            font-size: 32px;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            margin: 0;
            color: white;
        }
        .profile-header p {
            color: #aaa;
            margin: 5px 0 0 0;
            font-size: 15px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            color: #ccc;
            font-weight: 600;
        }
        .form-control {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            color: white;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255,255,255,0.08);
        }
        .form-control:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        .btn-save {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 700;
            font-size: 16px;
            font-family: 'Outfit', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }
        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(138,43,226,0.4);
        }
    </style>
</head>
<body style="background: var(--bg-dark); color: white;">

    <?= $this->element('navbar') ?>

    <div class="profile-container">
        <?= $this->Flash->render() ?>

        <div class="profile-card reveal">
            <div class="profile-header">
                <i class="ph-fill ph-user-circle"></i>
                <h2>My Profile</h2>
                <p>Update your personal information</p>
            </div>

            <?= $this->Form->create($user, ['class' => 'profile-form']) ?>
                <div class="form-group">
                    <label>Username</label>
                    <!-- Username is disabled to prevent accidental changing of login credentials -->
                    <input type="text" name="Username" class="form-control" value="<?= h($user->Username) ?>" disabled>
                    <small style="color: #888; font-size: 12px; display: block; margin-top: 4px;">Username cannot be changed.</small>
                </div>
                
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="FullName" class="form-control" value="<?= h($user->FullName) ?>" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="Email" class="form-control" value="<?= h($user->Email) ?>" required>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="Phone" class="form-control" value="<?= h($user->Phone) ?>">
                </div>
                
                <?php if (isset($sessionUser) && strtolower($sessionUser->Role ?? '') === 'admin'): ?>
                    <div class="form-group">
                        <label>Role (Admin Only)</label>
                        <select name="Role" class="form-control">
                            <option value="Member" <?= strtolower($user->Role) === 'member' ? 'selected' : '' ?>>Member</option>
                            <option value="Trainer" <?= strtolower($user->Role) === 'trainer' ? 'selected' : '' ?>>Trainer</option>
                            <option value="Admin" <?= strtolower($user->Role) === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn-save">Save Changes</button>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <?= $this->Html->script('animations', ['defer' => true]) ?>
    <?= $this->element('footer') ?>
</body>
</html>
