<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Trainers - Anytime Fitness</title>
    
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

    <!-- Navigation -->
    <?= $this->element('navbar', ['active' => 'trainers']) ?>

    <!-- Header -->
    <div style="background: linear-gradient(135deg, var(--bg-dark), #2a1440); padding: 80px 50px; text-align: center; border-bottom: 1px solid var(--glass-border);">
        <h1>Meet Our Expert Trainers</h1>
        <p>Dedicated professionals ready to guide you on your judgment-free journey.</p>
    </div>

    <!-- Trainers Section -->
    <section class="trainers-section" style="padding: 100px 50px; background: var(--bg-dark); max-width: 1200px; margin: 0 auto;">
        
        <div class="trainer-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">
            <!-- Trainer 1 -->
            <div class="trainer-card" style="display: flex; flex-direction: column; background: var(--glass-bg); border: 1px solid var(--glass-border); border-radius: 20px; overflow: hidden; text-align: center; padding-bottom: 20px; transition: transform 0.3s ease;">
                <?= $this->Html->image('trainer_1.png', ['alt' => 'Trainer 1', 'style' => 'width: 100%; height: 350px; object-fit: cover; object-position: top; border-bottom: 3px solid var(--primary);']) ?>
                <h3 style="margin: 20px 0 5px; font-size: 24px;">Ain Syafinaz</h3>
                <p style="color: var(--primary); font-weight: 600; margin-bottom: 15px;">Lead Strength Coach</p>
                <p style="padding: 0 20px; color: #ccc; font-size: 14px;">Specializes in powerlifting and bodybuilding. Ain helps you build the ultimate foundation of strength.</p>
                <a href="<?= $this->Url->build('/') ?>" class="btn btn-primary" style="padding: 8px 20px; font-size: 14px; margin-top: auto; align-self: center;">Book Session</a>
            </div>
            
            <!-- Trainer 2 -->
            <div class="trainer-card" style="display: flex; flex-direction: column; background: var(--glass-bg); border: 1px solid var(--glass-border); border-radius: 20px; overflow: hidden; text-align: center; padding-bottom: 20px; transition: transform 0.3s ease;">
                <?= $this->Html->image('trainer_2.png', ['alt' => 'Trainer 2', 'style' => 'width: 100%; height: 350px; object-fit: cover; object-position: top; border-bottom: 3px solid var(--primary);']) ?>
                <h3 style="margin: 20px 0 5px; font-size: 24px;">Nurliyana Najwa</h3>
                <p style="color: var(--primary); font-weight: 600; margin-bottom: 15px;">HIIT & Mobility Specialist</p>
                <p style="padding: 0 20px; color: #ccc; font-size: 14px;">Focuses on functional fitness, mobility, and high-intensity interval training for maximum fat burn.</p>
                <a href="<?= $this->Url->build('/') ?>" class="btn btn-primary" style="padding: 8px 20px; font-size: 14px; margin-top: auto; align-self: center;">Book Session</a>
            </div>
            
            <!-- Trainer 3 -->
            <div class="trainer-card" style="display: flex; flex-direction: column; background: var(--glass-bg); border: 1px solid var(--glass-border); border-radius: 20px; overflow: hidden; text-align: center; padding-bottom: 20px; transition: transform 0.3s ease;">
                <?= $this->Html->image('trainer_3.png', ['alt' => 'Trainer 3', 'style' => 'width: 100%; height: 350px; object-fit: cover; object-position: top; border-bottom: 3px solid var(--primary);']) ?>
                <h3 style="margin: 20px 0 5px; font-size: 24px;">Faris Afizuan</h3>
                <p style="color: var(--primary); font-weight: 600; margin-bottom: 15px;">Transformation Expert</p>
                <p style="padding: 0 20px; color: #ccc; font-size: 14px;">Dedicated to complete body transformations through tailored nutrition and strategic training protocols.</p>
                <a href="<?= $this->Url->build('/') ?>" class="btn btn-primary" style="padding: 8px 20px; font-size: 14px; margin-top: auto; align-self: center;">Book Session</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?= $this->element('footer') ?>

</body>
</html>
