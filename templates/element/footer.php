<footer style="background: rgba(10, 10, 12, 0.95); border-top: 1px solid rgba(255,255,255,0.05); padding: 60px 40px 30px; margin-top: auto;">
    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px;">
        
        <!-- Brand & Info -->
        <div>
            <div style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 800; color: white; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px;">
                Anytime<span style="color: var(--primary);">Fitness</span>
            </div>
            <p style="color: #aaa; font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                Transform your life with world-class facilities, expert coaching, and a supportive community. Your fitness journey starts here.
            </p>
            <div style="display: flex; gap: 15px;">
                <a href="https://www.facebook.com/anytimefitnessecoardence/" style="color: white; font-size: 24px; transition: color 0.3s;" target="_blank"><i class="ph-fill ph-facebook-logo"></i></a>
                <a href="https://www.instagram.com/af.ecoardence/?hl=en" style="color: white; font-size: 24px; transition: color 0.3s;" target="_blank"><i class="ph-fill ph-instagram-logo"></i></a>
                <a href="#" style="color: white; font-size: 24px; transition: color 0.3s;"><i class="ph-fill ph-twitter-logo"></i></a>
            </div>
        </div>

        <!-- Quick Links -->
        <div>
            <h4 style="color: white; font-family: 'Outfit', sans-serif; font-size: 18px; margin-bottom: 20px;">Quick Links</h4>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                <li><a href="<?= $this->Url->build('/') ?>" style="color: #aaa; text-decoration: none; font-size: 14px; transition: color 0.3s;">Home</a></li>
                <li><a href="<?= $this->Url->build('/schedule') ?>" style="color: #aaa; text-decoration: none; font-size: 14px; transition: color 0.3s;">Class Schedule</a></li>
                <li><a href="<?= $this->Url->build('/our-trainers') ?>" style="color: #aaa; text-decoration: none; font-size: 14px; transition: color 0.3s;">Our Trainers</a></li>
                <li><a href="<?= $this->Url->build('/private-coaching') ?>" style="color: #aaa; text-decoration: none; font-size: 14px; transition: color 0.3s;">Private Coaching</a></li>
            </ul>
        </div>

        <!-- Contact & Legal -->
        <div>
            <h4 style="color: white; font-family: 'Outfit', sans-serif; font-size: 18px; margin-bottom: 20px;">Contact & Legal</h4>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                <li style="color: #aaa; font-size: 14px; display: flex; align-items: flex-start; gap: 8px;">
                    <i class="ph-fill ph-map-pin" style="color: var(--primary); font-size: 18px; flex-shrink: 0; margin-top: 2px;"></i>
                    <a href="https://www.google.com/maps/search/?api=1&query=Anytime+Fitness+Eco+Ardence,+Eco+Ardence,+H4,+3rd+Floor,+Hana+Square,+Jln+U13%2F55D,+40170+Shah+Alam,+Selangor" target="_blank" style="color: #aaa; text-decoration: none; line-height: 1.5; transition: color 0.3s;">Anytime Fitness Eco Ardence, Eco Ardence, H4, 3rd Floor, Hana Square, Jln U13/55D, 40170 Shah Alam, Selangor</a>
                </li>
                <li style="color: #aaa; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                    <i class="ph-fill ph-printer" style="color: var(--primary); font-size: 18px;"></i>
                    <span style="color: #aaa;">Fax: 038894660</span>
                </li>
                <li style="color: #aaa; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                    <i class="ph-fill ph-envelope" style="color: var(--primary); font-size: 18px;"></i>
                    contact@anytimefitness.demo
                </li>
                <li style="color: #aaa; font-size: 14px; display: flex; align-items: center; gap: 8px; margin-top: 10px;">
                    <a href="#" style="color: #888; text-decoration: none; font-size: 13px;">Privacy Policy</a> &nbsp;|&nbsp; 
                    <a href="#" style="color: #888; text-decoration: none; font-size: 13px;">Terms</a>
                </li>
            </ul>
        </div>
    </div>
    
    <div style="max-width: 1200px; margin: 40px auto 0; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.05); text-align: center;">
        <p style="color: #555; font-size: 12px; margin: 0;">
            © <?= date('Y') ?> Anytime Fitness. All rights reserved. This is a demo application.
        </p>
    </div>
</footer>
<style>
    footer a:hover { color: var(--primary) !important; }
</style>
