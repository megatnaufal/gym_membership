<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anytime Fitness - Your Judgment-Free Gym</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->Url->assetUrl('favicon.ico?v=' . time()) ?>">
    
    <?= $this->Html->css('anytime_home') ?>
    
    <!-- Using Phosphor Icons for modern premium icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <?= $this->Html->script('animations', ['defer' => true]) ?>

    <style>
        /* My Classes Section */
        .my-classes-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 50px;
        }
        .my-classes-section .section-title { margin-bottom: 30px; }
        .classes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .class-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 24px;
            transition: transform 0.2s ease, border-color 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        .class-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--primary);
        }
        .class-card:hover {
            transform: translateY(-4px);
            border-color: var(--primary);
        }
        .class-card h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            color: white;
        }
        .class-meta {
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-size: 13px;
            color: #aaa;
        }
        .class-meta span {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .class-meta i { color: var(--primary); font-size: 15px; }
        .status-badge {
            display: inline-block;
            margin-top: 14px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-booked   { background: rgba(46,204,113,0.15); color: #2ecc71; border: 1px solid rgba(46,204,113,0.3); }
        .status-waitlist { background: rgba(231,76,60,0.15);  color: #e74c3c; border: 1px solid rgba(231,76,60,0.3); }
        .no-classes-box {
            background: var(--glass-bg);
            border: 1px dashed var(--glass-border);
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            color: #666;
        }
        .no-classes-box i { font-size: 40px; margin-bottom: 12px; display: block; color: #444; }
    </style>
</head>
<body>

    <!-- Navigation -->
    <?= $this->element('navbar', ['active' => 'home']) ?>

    <!-- Flash notification bar — fixed at top, auto-dismisses -->
    <div id="flashZone" style="position: fixed; top: 80px; left: 50%; transform: translateX(-50%); width: 100%; max-width: 700px; z-index: 1100; padding: 0 20px; pointer-events: none;">
        <div style="pointer-events: all;">
            <?= $this->Flash->render() ?>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <?php if (!empty($user)): ?>
                <h1>Welcome Back, <?= h(explode(' ', $user->FullName)[0]) ?>!</h1>
                
                <?php if (strtolower($user->Role ?? '') === 'member'): ?>
                    <?php if (!empty($activeMembership) && strtolower($activeMembership->Status ?? '') === 'active'): ?>
                        <div style="margin: 18px 0 24px; background: rgba(0, 210, 255, 0.15); border: 1px solid rgba(0, 210, 255, 0.4); border-radius: 14px; padding: 16px 24px; display: inline-flex; align-items: center; gap: 16px; backdrop-filter: blur(10px); text-align: left; box-shadow: 0 4px 20px rgba(0,210,255,0.2);">
                            <i class="ph-fill ph-shield-check" style="font-size: 32px; color: var(--secondary);"></i>
                            <div>
                                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--secondary); font-weight: 700; font-family: 'Outfit', sans-serif;">Active Membership</div>
                                <div style="font-size: 17px; font-weight: 700; color: white; font-family: 'Outfit', sans-serif;">
                                    <?= h($activeMembership->package->PackageName ?? 'Gym Pass') ?>
                                </div>
                                <div style="font-size: 12px; color: #bbb; margin-top: 2px;">
                                    Valid until <strong><?= h($activeMembership->EndDate->format('d M Y')) ?></strong>
                                </div>
                            </div>
                            <a href="<?= $this->Url->build('/memberships/status') ?>" class="btn" style="margin-left: 12px; background: rgba(255,255,255,0.12); color: white; border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; padding: 8px 16px; font-size: 13px; text-decoration: none; font-weight: 600;">
                                Manage
                            </a>
                        </div>
                    <?php else: ?>
                        <div style="margin: 18px 0 24px; background: rgba(231, 76, 60, 0.15); border: 1px solid rgba(231, 76, 60, 0.4); border-radius: 14px; padding: 16px 24px; display: inline-flex; align-items: center; gap: 16px; backdrop-filter: blur(10px); text-align: left;">
                            <i class="ph-fill ph-warning-circle" style="font-size: 32px; color: #e74c3c;"></i>
                            <div>
                                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #e74c3c; font-weight: 700;">No Active Membership</div>
                                <div style="font-size: 14px; color: white;">Join a membership plan to unlock 24/7 access & class bookings.</div>
                            </div>
                            <a href="#pricing" class="btn btn-primary" style="margin-left: 12px; padding: 8px 16px; font-size: 13px; text-decoration: none; font-weight: 600;">
                                Get Access
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div style="display: flex; gap: 12px; justify-content: center;">
                    <?php if (strtolower($user->Role ?? '') === 'trainer'): ?>
                        <a href="<?= $this->Url->build('/trainer') ?>" class="btn btn-primary" style="animation: float 6s ease-in-out infinite;">Go to Trainer Portal</a>
                    <?php elseif (strtolower($user->Role ?? '') === 'admin'): ?>
                        <a href="<?= $this->Url->build('/admin') ?>" class="btn btn-primary" style="animation: float 6s ease-in-out infinite;">Go to Admin Portal</a>
                    <?php else: ?>
                        <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary">View Class Schedule</a>
                        <a href="<?= $this->Url->build('/memberships/status') ?>" class="btn" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); color: white;">Digital Pass & Status</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <h1 style="font-family: 'Outfit', sans-serif;" class="reveal">Elevate Your <span class="text-gradient">Fitness Journey</span></h1>
                <p class="reveal">Experience a premium, judgment-free environment designed for your success. State-of-the-art facilities, expert coaching, and a thriving community await.</p>
                <div style="display: flex; gap: 15px; justify-content: center; margin-top: 20px;" class="reveal">
                    <a href="#pricing" class="btn btn-primary" style="animation: float 6s ease-in-out infinite;">Join Now</a>
                    <a href="#trainers" class="btn" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">Meet Trainers</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- MY CLASSES SECTION (only shown when logged in and is a member) -->
    <?php if (!empty($user) && strtolower($user->Role ?? '') === 'member'): ?>
    <section class="my-classes-section">
        <h2 class="section-title">My <span>Booked Classes</span></h2>

        <?php if (!empty($myBookings)): ?>
            <div class="classes-grid">
                <?php foreach ($myBookings as $booking): ?>
                    <?php $class = $booking->gym_class ?? $booking->_matchingData['Classes'] ?? null; ?>
                    <?php if ($class): ?>
                    <div class="class-card">
                        <h4><?= h($class->ClassName) ?></h4>
                        <div class="class-meta">
                            <span>
                                <i class="ph ph-calendar"></i>
                                <?= h($class->StartTime->format('D, d M Y')) ?>
                            </span>
                            <span>
                                <i class="ph ph-clock"></i>
                                <?= h($class->StartTime->format('h:i A')) ?> – <?= h($class->EndTime->format('h:i A')) ?>
                            </span>
                            <?php if (!empty($class->trainer)): ?>
                            <span>
                                <i class="ph ph-chalkboard-teacher"></i>
                                <?= h($class->trainer->FullName) ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        <?php
                            $status = $booking->AttendanceStatus ?? 'Booked';
                            $badgeClass = strtolower($status) === 'waitlisted' ? 'status-waitlist' : 'status-booked';
                        ?>
                        <span class="status-badge <?= $badgeClass ?>"><?= h($status) ?></span>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div style="text-align: center; margin-top: 30px;">
                <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary">
                    <i class="ph ph-plus"></i> Book More Classes
                </a>
            </div>
        <?php else: ?>
            <div class="no-classes-box">
                <i class="ph ph-calendar-x"></i>
                <p style="font-size: 16px; margin-bottom: 16px;">You have not booked any classes yet.</p>
                <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary">Browse Classes</a>
            </div>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <!-- Features Section -->
    <section id="about" class="features reveal" style="padding: 100px 50px;">
        <h2 class="section-title" style="font-family: 'Outfit', sans-serif;">Everything You <span class="text-gradient">Need</span></h2>
        
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
                <i class="ph ph-clock card-icon"></i>
                <h3>24/7 Access</h3>
                <p>Our doors are never closed. Work out whenever you want, day or night, with our secure key fob access.</p>
            </div>
        </div>
    <!-- Membership Plans & Pricing Section -->
    <section id="pricing" class="pricing-section reveal" style="padding: 80px 50px 40px; max-width: 1200px; margin: 0 auto;">
        <h2 class="section-title">Membership <span class="text-gradient">Plans &amp; Access</span></h2>
        <p style="text-align: center; color: #aaa; margin-top: -30px; margin-bottom: 50px; font-size: 16px;">
            Choose the membership tier that fits your fitness journey. Instant key fob access included.
        </p>

        <div class="pricing-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 40px;">
            <?php if (!empty($packages)): ?>
                <?php foreach ($packages as $pkg): ?>
                    <?php 
                        $isBasic = strtolower($pkg->PackageName ?? '') === 'basic gym access';
                        $isPopular = strtolower($pkg->PackageName ?? '') === 'unlimited group classes';
                    ?>
                    <div class="pricing-card" style="background: var(--glass-bg); border: 1px solid <?= $isPopular ? 'var(--primary)' : 'rgba(255,255,255,0.05)' ?>; border-top: 1px solid rgba(255,255,255,0.1); border-radius: 24px; padding: 40px 30px; position: relative; display: flex; flex-direction: column; backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); box-shadow: <?= $isPopular ? '0 10px 40px rgba(138,43,226,0.3)' : '0 20px 40px -10px rgba(0,0,0,0.4)' ?>; <?= $isPopular ? 'animation: pulse-glow 4s infinite;' : '' ?>">
                        
                        <?php if ($isPopular): ?>
                            <div style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 6px 20px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 15px rgba(138,43,226,0.4);">
                                Most Popular
                            </div>
                        <?php elseif ($isBasic): ?>
                            <div style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: #3498db; color: white; padding: 4px 16px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px;">
                                Essential Pass
                            </div>
                        <?php endif; ?>

                        <h3 style="font-size: 22px; margin-bottom: 12px; color: white;"><?= h($pkg->PackageName) ?></h3>
                        <div style="font-size: 38px; font-weight: 800; color: white; margin-bottom: 20px; display: flex; align-items: baseline; gap: 4px;">
                            <span style="font-size: 18px; color: var(--primary);">RM</span><?= h($pkg->Price) ?>
                            <span style="font-size: 13px; color: #888; font-weight: normal;">/<?= h(strtolower($pkg->BillingCycle)) ?></span>
                        </div>

                        <ul style="list-style: none; padding: 0; margin: 0 0 30px; flex-grow: 1;">
                            <?php if ($isBasic): ?>
                                <li style="margin-bottom: 12px; color: #ccc; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                                    <i class="ph-fill ph-check-circle" style="color: #3498db;"></i> 24/7 Unlimited Gym Access
                                </li>
                                <li style="margin-bottom: 12px; color: #ccc; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                                    <i class="ph-fill ph-check-circle" style="color: #3498db;"></i> All Strength &amp; Cardio Equipment
                                </li>
                                <li style="margin-bottom: 12px; color: #ccc; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                                    <i class="ph-fill ph-check-circle" style="color: #3498db;"></i> Locker Room &amp; Hot Showers
                                </li>
                                <li style="margin-bottom: 12px; color: #ccc; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                                    <i class="ph-fill ph-check-circle" style="color: #3498db;"></i> Digital Pass &amp; Check-in App
                                </li>
                            <?php else: ?>
                                <li style="margin-bottom: 12px; color: #ccc; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                                    <i class="ph-fill ph-check-circle" style="color: var(--primary);"></i> 24/7 Global Club Access
                                </li>
                                <li style="margin-bottom: 12px; color: #ccc; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                                    <i class="ph-fill ph-check-circle" style="color: var(--primary);"></i> Unlimited Fitness Classes
                                </li>
                                <li style="margin-bottom: 12px; color: #ccc; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                                    <i class="ph-fill ph-check-circle" style="color: var(--primary);"></i> Personal Coach Consultation
                                </li>
                            <?php endif; ?>
                        </ul>

                        <a href="<?= $this->Url->build(['controller' => 'Checkout', 'action' => 'package', $pkg->PackageID]) ?>" class="btn btn-primary" style="text-align: center; display: block; padding: 12px; width: 100%; text-decoration: none; <?= !$isPopular && !$isBasic ? 'background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2);' : '' ?>">
                            Get <?= h($pkg->PackageName) ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Trainers Section -->
    <section id="trainers" class="trainers-section reveal" style="padding: 100px 50px 50px; background: var(--bg-dark); max-width: 1400px; margin: 0 auto;">
        <h2 class="section-title">Meet Our <span class="text-gradient">Expert Trainers</span></h2>
        
        <style>
            .trainer-card {
                display: flex; flex-direction: column; background: var(--glass-bg); border: 1px solid rgba(255,255,255,0.05); border-top: 1px solid rgba(255,255,255,0.1); border-radius: 20px; overflow: hidden; text-align: center; padding-bottom: 20px; transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.4s ease; box-shadow: 0 20px 40px -10px rgba(0,0,0,0.4);
            }
            .trainer-card:hover {
                transform: translateY(-15px); box-shadow: 0 30px 60px -15px rgba(138,43,226,0.3); border-color: rgba(255,255,255,0.15);
            }
            .trainer-card img {
                transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            }
            .trainer-card:hover img {
                transform: scale(1.08);
            }
        </style>

        <div class="trainer-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px;">
            <!-- Trainer 1 -->
            <div class="trainer-card">
                <div style="overflow: hidden; border-bottom: 3px solid var(--primary);">
                    <?= $this->Html->image('trainer_1.png', ['alt' => 'Trainer 1', 'style' => 'width: 100%; height: 350px; object-fit: cover; object-position: top; display: block;']) ?>
                </div>
                <h3 style="margin: 20px 0 5px; font-size: 24px;">Ain Syafinaz</h3>
                <p style="color: var(--secondary); font-weight: 600; margin-bottom: 15px;">Lead Strength Coach</p>
                <p style="padding: 0 20px; color: #ccc; font-size: 14px;">Specializes in powerlifting and bodybuilding. Ain helps you build the ultimate foundation of strength.</p>
                <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary" style="padding: 8px 20px; font-size: 14px; margin-top: auto; align-self: center;">Book Session</a>
            </div>
            
            <!-- Trainer 2 -->
            <div class="trainer-card">
                <div style="overflow: hidden; border-bottom: 3px solid var(--primary);">
                    <?= $this->Html->image('trainer_2.png', ['alt' => 'Trainer 2', 'style' => 'width: 100%; height: 350px; object-fit: cover; object-position: top; display: block;']) ?>
                </div>
                <h3 style="margin: 20px 0 5px; font-size: 24px;">Nurliyana Najwa</h3>
                <p style="color: var(--secondary); font-weight: 600; margin-bottom: 15px;">HIIT &amp; Mobility Specialist</p>
                <p style="padding: 0 20px; color: #ccc; font-size: 14px;">Focuses on functional fitness, mobility, and high-intensity interval training for maximum fat burn.</p>
                <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary" style="padding: 8px 20px; font-size: 14px; margin-top: auto; align-self: center;">Book Session</a>
            </div>
            
            <!-- Trainer 3 -->
            <div class="trainer-card">
                <div style="overflow: hidden; border-bottom: 3px solid var(--primary);">
                    <?= $this->Html->image('trainer_3.png', ['alt' => 'Trainer 3', 'style' => 'width: 100%; height: 350px; object-fit: cover; object-position: top; display: block;']) ?>
                </div>
                <h3 style="margin: 20px 0 5px; font-size: 24px;">Faris Afizuan</h3>
                <p style="color: var(--secondary); font-weight: 600; margin-bottom: 15px;">Transformation Expert</p>
                <p style="padding: 0 20px; color: #ccc; font-size: 14px;">Dedicated to complete body transformations through tailored nutrition and strategic training protocols.</p>
                <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary" style="padding: 8px 20px; font-size: 14px; margin-top: auto; align-self: center;">Book Session</a>
            </div>
            
            <!-- Trainer 4 -->
            <div class="trainer-card">
                <div style="overflow: hidden; border-bottom: 3px solid var(--primary);">
                    <?= $this->Html->image('trainer_4.png?v=1', ['alt' => 'Trainer 4', 'style' => 'width: 100%; height: 350px; object-fit: cover; object-position: top; display: block;']) ?>
                </div>
                <h3 style="margin: 20px 0 5px; font-size: 24px;">Megat Naufal</h3>
                <p style="color: var(--secondary); font-weight: 600; margin-bottom: 15px;">Muscle Building & Body Recomposition Coach</p>
                <p style="padding: 0 20px; color: #ccc; font-size: 14px;">Expert in hypertrophy and body recomposition to help you achieve your ultimate aesthetic physique.</p>
                <a href="<?= $this->Url->build('/schedule') ?>" class="btn btn-primary" style="padding: 8px 20px; font-size: 14px; margin-top: auto; align-self: center;">Book Session</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?= $this->element('footer') ?>


    <script>
        // Auto-dismiss flash banners after 5 seconds
        document.addEventListener('DOMContentLoaded', function () {
            var banners = document.querySelectorAll('.flash-banner');
            banners.forEach(function (banner) {
                setTimeout(function () {
                    banner.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    banner.style.opacity = '0';
                    banner.style.transform = 'translateY(-10px)';
                    setTimeout(function () { banner.style.display = 'none'; }, 600);
                }, 5000);
            });
    </script>

    <?php if (empty($user)): ?>
        
    <?php endif; ?>
</body>
</html>
