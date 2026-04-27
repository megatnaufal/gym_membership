<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anytime Fitness - Your Judgment-Free Gym</title>
    
    <?= $this->Html->css('anytime_home') ?>
    
    <!-- Using Phosphor Icons for modern premium icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-brand">
            <a href="/">Anytime<span>Fitness</span></a>
        </div>
        <div class="nav-links">
            <a href="<?= $this->Url->build('/our-trainers') ?>">Our Trainers</a>
            <a href="<?= $this->Url->build('/private-coaching') ?>">Private Coaching</a>
            <a href="<?= $this->Url->build('/shop') ?>">Shop</a>
            <a href="<?= $this->Url->build('/') ?>">Why Join</a>
        </div>
        <a href="<?= $this->Url->build('/') ?>" class="nav-cta">Join Now</a>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Your Judgment-Free Fitness Journey</h1>
            <p>Find a welcoming community where you can train in peace without facing the judgment of others. Get access to state-of-the-art facilities, private coaching, and premium supplies.</p>
            <a href="#trainers" class="btn btn-primary">Meet Our Trainers</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2 class="section-title">Everything You <span>Need</span></h2>
        
        <div class="grid">
            <div class="card">
                <i class="ph ph-hand-heart card-icon"></i>
                <h3>Judgment-Free Zone</h3>
                <p>We provide a safe, welcoming environment for everyone. Train comfortably without feeling intimidated or judged.</p>
            </div>
            
            <div class="card">
                <i class="ph ph-chalkboard-teacher card-icon"></i>
                <h3>Private Coaching</h3>
                <p>Achieve your goals faster with our expert private coaches. Get 1-on-1 personalized training plans tailored to you.</p>
            </div>
            
            <div class="card">
                <i class="ph ph-storefront card-icon"></i>
                <h3>Pro Gym Shop</h3>
                <p>Get all the supplies you need, from premium supplements to top-tier workout gear, right in our integrated online store.</p>
            </div>
            
            <div class="card">
                <i class="ph ph-clock card-icon"></i>
                <h3>24/7 Access</h3>
                <p>Our doors are never closed. Work out whenever you want, day or night, with our secure key fob access.</p>
            </div>
        </div>
    </section>

    <!-- Trainers Section -->
    <section id="trainers" class="trainers-section" style="padding: 100px 50px 50px; background: var(--bg-dark); max-width: 1200px; margin: 0 auto;">
        <h2 class="section-title">Meet Our <span>Expert Trainers</span></h2>
        
        <div class="trainer-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">
            <!-- Trainer 1 -->
            <div class="trainer-card" style="background: var(--glass-bg); border: 1px solid var(--glass-border); border-radius: 20px; overflow: hidden; text-align: center; padding-bottom: 20px; transition: transform 0.3s ease;">
                <?= $this->Html->image('trainer_1.png', ['alt' => 'Trainer 1', 'style' => 'width: 100%; height: 350px; object-fit: cover; border-bottom: 3px solid var(--primary);']) ?>
                <h3 style="margin: 20px 0 5px; font-size: 24px;">Marcus Vance</h3>
                <p style="color: var(--primary); font-weight: 600; margin-bottom: 15px;">Lead Strength Coach</p>
                <p style="padding: 0 20px; color: #ccc; font-size: 14px;">Specializes in powerlifting and bodybuilding. Marcus helps you build the ultimate foundation of strength.</p>
                <a href="<?= $this->Url->build('/') ?>" class="btn btn-primary" style="padding: 8px 20px; font-size: 14px; margin-top: 10px;">Book Session</a>
            </div>
            
            <!-- Trainer 2 -->
            <div class="trainer-card" style="background: var(--glass-bg); border: 1px solid var(--glass-border); border-radius: 20px; overflow: hidden; text-align: center; padding-bottom: 20px; transition: transform 0.3s ease;">
                <?= $this->Html->image('trainer_2.png', ['alt' => 'Trainer 2', 'style' => 'width: 100%; height: 350px; object-fit: cover; border-bottom: 3px solid var(--primary);']) ?>
                <h3 style="margin: 20px 0 5px; font-size: 24px;">Sarah Jenkins</h3>
                <p style="color: var(--primary); font-weight: 600; margin-bottom: 15px;">HIIT & Mobility Specialist</p>
                <p style="padding: 0 20px; color: #ccc; font-size: 14px;">Focuses on functional fitness, mobility, and high-intensity interval training for maximum fat burn.</p>
                <a href="<?= $this->Url->build('/') ?>" class="btn btn-primary" style="padding: 8px 20px; font-size: 14px; margin-top: 10px;">Book Session</a>
            </div>
            
            <!-- Trainer 3 -->
            <div class="trainer-card" style="background: var(--glass-bg); border: 1px solid var(--glass-border); border-radius: 20px; overflow: hidden; text-align: center; padding-bottom: 20px; transition: transform 0.3s ease;">
                <?= $this->Html->image('trainer_3.png', ['alt' => 'Trainer 3', 'style' => 'width: 100%; height: 350px; object-fit: cover; border-bottom: 3px solid var(--primary);']) ?>
                <h3 style="margin: 20px 0 5px; font-size: 24px;">David Chen</h3>
                <p style="color: var(--primary); font-weight: 600; margin-bottom: 15px;">Transformation Expert</p>
                <p style="padding: 0 20px; color: #ccc; font-size: 14px;">Dedicated to complete body transformations through tailored nutrition and strategic training protocols.</p>
                <a href="<?= $this->Url->build('/') ?>" class="btn btn-primary" style="padding: 8px 20px; font-size: 14px; margin-top: 10px;">Book Session</a>
            </div>
        </div>
    </section>

    <!-- Shop CTA Section -->
    <section style="padding: 50px 50px 100px; max-width: 1200px; margin: 0 auto; text-align: center;">
        <div style="background: var(--glass-bg); padding: 60px 40px; border-radius: 20px; border: 1px solid var(--glass-border); backdrop-filter: blur(10px);">
            <i class="ph ph-shopping-bag" style="font-size: 64px; color: var(--primary); margin-bottom: 20px;"></i>
            <h2 style="font-size: 36px; font-weight: 800; margin-bottom: 20px;">Gear Up for Success</h2>
            <p style="font-size: 18px; margin-bottom: 40px; color: #ccc; max-width: 600px; margin-left: auto; margin-right: auto;">Visit our shop to find exclusive apparel, premium supplements, and all the essential supplies you need to crush your next workout.</p>
            <a href="<?= $this->Url->build('/shop') ?>" class="btn btn-primary">Visit Our Shop</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="#">Careers</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>
        <p style="color: #555; font-size: 12px;">© <?= date('Y') ?> Anytime Fitness. All rights reserved. This is a clone for demonstration purposes.</p>
    </footer>

</body>
</html>
