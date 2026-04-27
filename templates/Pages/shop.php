<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pro Gym Shop - Anytime Fitness</title>
    
    <!-- We can reuse anytime_home for base styles and override/add with anytime_shop -->
    <?= $this->Html->css(['anytime_home', 'anytime_shop']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar" style="background: rgba(15, 15, 17, 0.95); position: sticky;">
        <div class="nav-brand">
            <a href="/">Anytime<span>Fitness</span></a>
        </div>
        <div class="nav-links">
            <a href="<?= $this->Url->build('/our-trainers') ?>">Our Trainers</a>
            <a href="<?= $this->Url->build('/private-coaching') ?>">Private Coaching</a>
            <a href="<?= $this->Url->build('/shop') ?>" style="color: var(--primary);">Shop</a>
            <a href="<?= $this->Url->build('/') ?>">Why Join</a>
        </div>
        <a href="<?= $this->Url->build('/shop') ?>" class="nav-cta" style="display: flex; align-items: center; gap: 8px;"><i class="ph ph-shopping-cart" style="font-size: 20px;"></i> Cart (0)</a>
    </nav>

    <!-- Shop Header -->
    <div class="shop-header">
        <h1>Pro Gym Shop</h1>
        <p>Premium gear, apparel, and supplements to power your judgment-free journey.</p>
    </div>

    <!-- Shop Content -->
    <div class="shop-container">
        <!-- Sidebar -->
        <aside class="shop-sidebar">
            <h3>Categories</h3>
            <ul>
                <li><a href="#" class="active">All Products</a></li>
                <li><a href="#">Supplements</a></li>
                <li><a href="#">Apparel</a></li>
                <li><a href="#">Accessories</a></li>
            </ul>
        </aside>

        <!-- Product Grid -->
        <main class="shop-grid">
            <div class="product-card">
                <div class="product-image">
                    <?= $this->Html->image('product_whey.png', ['alt' => 'Premium Whey Isolate']) ?>
                </div>
                <div class="product-info">
                    <h4>Premium Whey Isolate</h4>
                    <span class="price">$49.99</span>
                    <button class="btn btn-primary add-to-cart">Add to Cart</button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <?= $this->Html->image('product_shirt.png', ['alt' => 'Anytime Performance Tee']) ?>
                </div>
                <div class="product-info">
                    <h4>Performance Tee</h4>
                    <span class="price">$29.99</span>
                    <button class="btn btn-primary add-to-cart">Add to Cart</button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <?= $this->Html->image('product_bag.png', ['alt' => 'Elite Duffel Bag']) ?>
                </div>
                <div class="product-info">
                    <h4>Elite Duffel Bag</h4>
                    <span class="price">$59.99</span>
                    <button class="btn btn-primary add-to-cart">Add to Cart</button>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer style="margin-top: 50px;">
        <div class="footer-links">
            <a href="<?= $this->Url->build('/') ?>">Home</a>
            <a href="<?= $this->Url->build('/') ?>">Careers</a>
            <a href="<?= $this->Url->build('/') ?>">Privacy Policy</a>
            <a href="<?= $this->Url->build('/') ?>">Terms & Conditions</a>
        </div>
        <p style="color: #555; font-size: 12px;">© <?= date('Y') ?> Anytime Fitness. All rights reserved.</p>
    </footer>

</body>
</html>
