<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Trainer> $trainers
 * @var array $trainerAvailability
 * @var \App\Model\Entity\User $user
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
    <style>
        .trainer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .trainer-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: var(--glass-shadow);
        }
        .trainer-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }
        .trainer-avatar {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--primary);
        }
        .trainer-avatar i { font-size: 40px; color: white; }
        .trainer-info h2 { margin: 0 0 5px 0; font-family: 'Outfit', sans-serif; font-size: 24px; color: white; }
        .trainer-info p { margin: 0; color: #aaa; font-size: 14px; display: flex; align-items: center; gap: 5px; }
        
        .booking-form {
            background: rgba(0,0,0,0.2);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .booking-form h4 {
            margin: 0 0 15px 0;
            color: white;
            font-size: 16px;
            font-family: 'Outfit', sans-serif;
        }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 13px; color: #ccc; }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            color: white;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }
        .form-control:focus { outline: none; border-color: var(--primary); }
        .form-control option { background: #1a1a1a; color: white; }
        
        .btn-book {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn-book:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(138,43,226,0.3); }
        .btn-disabled { background: rgba(255,255,255,0.1); color: #888; cursor: not-allowed; }
        
        .no-availability {
            text-align: center;
            padding: 20px;
            color: #aaa;
            font-size: 14px;
            background: rgba(255,255,255,0.02);
            border-radius: 8px;
        }
        
        .flash-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <?= $this->element('navbar', ['active' => 'coaching']) ?>

    <!-- Header -->
    <header class="pricing-header">
        <h1>Book 1-on-1 Coaching</h1>
        <p>Take your training to the next level. Book our expert trainers on their off-days for dedicated, personalized attention.</p>
    </header>

    <div class="flash-container">
        <?= $this->Flash->render() ?>
    </div>

    <!-- Trainers Grid -->
    <div class="trainer-grid">
        <?php foreach ($trainers as $trainer): ?>
            <div class="trainer-card">
                <div class="trainer-header">
                    <div class="trainer-avatar">
                        <i class="ph-fill ph-user-circle"></i>
                    </div>
                    <div class="trainer-info">
                        <h2><?= h($trainer->user->FullName ?? 'Trainer') ?></h2>
                        <p><i class="ph-fill ph-medal"></i> <?= h($trainer->Specialty ?? 'Fitness Expert') ?></p>
                    </div>
                </div>
                
                <?php $dates = $trainerAvailability[$trainer->UserID] ?? []; ?>
                
                <?php if (empty($dates)): ?>
                    <div class="no-availability">
                        <i class="ph ph-calendar-x" style="font-size: 32px; margin-bottom: 10px;"></i><br>
                        Currently fully booked. No off-days available in the next 14 days.
                    </div>
                <?php else: ?>
                    <div class="booking-form">
                        <h4>Book a Session</h4>
                        <?= $this->Form->create(null, ['url' => ['action' => 'coaching']]) ?>
                            <input type="hidden" name="trainer_id" value="<?= $trainer->UserID ?>">
                            
                            <div class="form-group">
                                <label>Available Date</label>
                                <select name="date" class="form-control" required>
                                    <option value="">Select a date...</option>
                                    <?php foreach ($dates as $date): ?>
                                        <option value="<?= h($date) ?>"><?= date('D, M j, Y', strtotime($date)) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Time Slot</label>
                                <select name="time" class="form-control" required>
                                    <option value="">Select a time...</option>
                                    <option value="09:00">09:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                    <option value="16:00">04:00 PM</option>
                                    <option value="17:00">05:00 PM</option>
                                    <option value="18:00">06:00 PM</option>
                                </select>
                            </div>
                            
                            <?php if ($user): ?>
                                <button type="submit" class="btn-book">Confirm Booking</button>
                            <?php else: ?>
                                <a href="<?= $this->Url->build('/?login=1') ?>" class="btn-book btn-disabled" style="display: block; text-align: center; text-decoration: none;">Log in to book</a>
                            <?php endif; ?>
                        <?= $this->Form->end() ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?= $this->element('footer') ?>
</body>
</html>
