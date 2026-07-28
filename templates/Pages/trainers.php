<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Trainers - Anytime Fitness</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <?= $this->Html->script('animations', ['defer' => true]) ?>

    <style>
        /* Modern Hero */
        .trainer-hero {
            position: relative;
            padding: 140px 20px 100px;
            text-align: center;
            background: linear-gradient(to bottom, rgba(138,43,226,0.05), var(--bg-dark));
            border-bottom: 1px solid var(--glass-border);
            overflow: hidden;
        }
        .trainer-hero::before {
            content: '';
            position: absolute;
            top: 50%; left: 50%; transform: translate(-50%, -50%);
            width: 80vw; height: 80vw; max-width: 1000px; max-height: 1000px;
            background: radial-gradient(circle, rgba(138,43,226,0.15) 0%, transparent 70%);
            z-index: 0;
            pointer-events: none;
        }
        .trainer-hero-content {
            position: relative;
            z-index: 1;
        }
        .trainer-hero h1 {
            font-size: 54px;
            font-weight: 800;
            font-family: 'Outfit', sans-serif;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }
        .trainer-hero p {
            font-size: 18px;
            color: #aaa;
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Premium Trainer Cards */
        .trainer-card {
            display: flex;
            flex-direction: column;
            background: var(--glass-bg);
            border: 1px solid rgba(255,255,255,0.05);
            border-top: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            overflow: hidden;
            text-align: center;
            padding-bottom: 30px;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.4);
            position: relative;
        }
        .trainer-card:hover {
            transform: translateY(-15px);
            border-color: rgba(255,255,255,0.15);
            box-shadow: 0 30px 60px -15px rgba(138,43,226,0.3);
            background: rgba(255,255,255,0.06);
        }
        .trainer-img-wrapper {
            position: relative;
            overflow: hidden;
            border-bottom: 3px solid var(--primary);
        }
        .trainer-img-wrapper img {
            width: 100%;
            height: 380px;
            object-fit: cover;
            object-position: top;
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .trainer-card:hover .trainer-img-wrapper img {
            transform: scale(1.08);
        }
        .trainer-socials {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 15px;
            opacity: 0;
            transition: opacity 0.4s ease, bottom 0.4s ease;
        }
        .trainer-card:hover .trainer-socials {
            opacity: 1;
            bottom: 30px;
        }
        .trainer-socials a {
            display: flex; align-items: center; justify-content: center;
            width: 40px; height: 40px;
            background: rgba(0,0,0,0.7);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 50%;
            color: white;
            font-size: 20px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        .trainer-socials a:hover {
            background: var(--primary);
            border-color: var(--primary);
            transform: translateY(-3px);
        }
        .trainer-name {
            margin: 25px 0 5px;
            font-size: 26px;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            color: white;
        }
        .trainer-role {
            color: var(--secondary);
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        .trainer-bio {
            padding: 0 25px;
            color: #aaa;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 25px;
            flex-grow: 1;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <?= $this->element('navbar', ['active' => 'trainers']) ?>

    <!-- Premium Header -->
    <div class="trainer-hero reveal">
        <div class="trainer-hero-content">
            <h1>Meet Our <span class="text-gradient">Expert Trainers</span></h1>
            <p>Dedicated professionals ready to guide you on your judgment-free fitness journey. Elite coaching tailored to your exact needs.</p>
        </div>
    </div>

    <!-- Trainers Section -->
    <section class="trainers-section" style="padding: 80px 50px 100px; max-width: 1400px; margin: 0 auto;">
        
        <div class="trainer-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px;">
            <!-- Trainer 1 -->
            <div class="trainer-card reveal">
                <div class="trainer-img-wrapper">
                    <?= $this->Html->image('trainer_1.png', ['alt' => 'Trainer 1']) ?>
                    <div class="trainer-socials">
                        <a href="#"><i class="ph ph-instagram-logo"></i></a>
                        <a href="#"><i class="ph ph-tiktok-logo"></i></a>
                        <a href="#"><i class="ph ph-twitter-logo"></i></a>
                    </div>
                </div>
                <h3 class="trainer-name">Ain Syafinaz</h3>
                <p class="trainer-role">Lead Strength Coach</p>
                <p class="trainer-bio">Specializes in powerlifting and bodybuilding. Ain helps you build the ultimate foundation of strength.</p>
                <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary" style="padding: 10px 24px; font-size: 14px; align-self: center;">Book Session</a>
            </div>
            
            <!-- Trainer 2 -->
            <div class="trainer-card reveal" style="transition-delay: 0.1s;">
                <div class="trainer-img-wrapper">
                    <?= $this->Html->image('trainer_2.png', ['alt' => 'Trainer 2']) ?>
                    <div class="trainer-socials">
                        <a href="#"><i class="ph ph-instagram-logo"></i></a>
                        <a href="#"><i class="ph ph-tiktok-logo"></i></a>
                        <a href="#"><i class="ph ph-twitter-logo"></i></a>
                    </div>
                </div>
                <h3 class="trainer-name">Nurliyana Najwa</h3>
                <p class="trainer-role">HIIT & Mobility Specialist</p>
                <p class="trainer-bio">Focuses on functional fitness, mobility, and high-intensity interval training for maximum fat burn.</p>
                <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary" style="padding: 10px 24px; font-size: 14px; align-self: center;">Book Session</a>
            </div>
            
            <!-- Trainer 3 -->
            <div class="trainer-card reveal" style="transition-delay: 0.2s;">
                <div class="trainer-img-wrapper">
                    <?= $this->Html->image('trainer_3.png', ['alt' => 'Trainer 3']) ?>
                    <div class="trainer-socials">
                        <a href="#"><i class="ph ph-instagram-logo"></i></a>
                        <a href="#"><i class="ph ph-tiktok-logo"></i></a>
                        <a href="#"><i class="ph ph-twitter-logo"></i></a>
                    </div>
                </div>
                <h3 class="trainer-name">Faris Afizuan</h3>
                <p class="trainer-role">Transformation Expert</p>
                <p class="trainer-bio">Dedicated to complete body transformations through tailored nutrition and strategic training protocols.</p>
                <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary" style="padding: 10px 24px; font-size: 14px; align-self: center;">Book Session</a>
            </div>
            
            <!-- Trainer 4 -->
            <div class="trainer-card reveal" style="transition-delay: 0.3s;">
                <div class="trainer-img-wrapper">
                    <?= $this->Html->image('trainer_4.png', ['alt' => 'Trainer 4']) ?>
                    <div class="trainer-socials">
                        <a href="#"><i class="ph ph-instagram-logo"></i></a>
                        <a href="#"><i class="ph ph-tiktok-logo"></i></a>
                        <a href="#"><i class="ph ph-twitter-logo"></i></a>
                    </div>
                </div>
                <h3 class="trainer-name">Megat Naufal</h3>
                <p class="trainer-role">Muscle Building & Body Recomposition Coach</p>
                <p class="trainer-bio">Expert in hypertrophy and body recomposition to help you achieve your ultimate aesthetic physique.</p>
                <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary" style="padding: 10px 24px; font-size: 14px; align-self: center;">Book Session</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?= $this->element('footer') ?>

</body>
</html>
