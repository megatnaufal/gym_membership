<?php
$this->assign('title', 'QR Scanner');
?>
<div class="page-header">
    <h1>Member Check-in Scanner</h1>
    <p>Scan a member's QR code to verify their membership and log attendance.</p>
</div>

<div style="display: flex; gap: 30px; margin-top: 20px;">
    <!-- Scanner Area -->
    <div style="flex: 1; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 24px; text-align: center;">
        <div id="reader" style="width: 100%; max-width: 500px; margin: 0 auto; border-radius: 12px; overflow: hidden; border: 2px solid var(--primary);"></div>
    </div>
    
    <!-- Results Area -->
    <div style="flex: 1; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 24px;">
        <h2 style="margin: 0 0 20px 0; font-family: 'Outfit', sans-serif; font-size: 20px; color: var(--primary);">Scan Results</h2>
        <div id="scan-result" style="padding: 20px; border-radius: 12px; background: rgba(0,0,0,0.2); font-size: 16px; min-height: 150px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
            <i class="ph ph-qr-code" style="font-size: 48px; color: #666; margin-bottom: 10px;"></i>
            <p style="color: #888; margin: 0;">Waiting for scan...</p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Prevent multiple rapid scans
        if (window.isScanning) return;
        window.isScanning = true;
        
        const resultDiv = document.getElementById('scan-result');
        resultDiv.innerHTML = '<i class="ph ph-spinner ph-spin" style="font-size: 40px; color: var(--primary);"></i><p>Verifying...</p>';
        resultDiv.style.background = 'rgba(138,43,226,0.1)';

        fetch('<?= $this->Url->build('/admin/check-in') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': <?= json_encode($this->request->getAttribute('csrfToken')) ?>
            },
            body: 'qr_token=' + encodeURIComponent(decodedText)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.status === 'Valid') {
                    resultDiv.innerHTML = `<i class="ph-fill ph-check-circle" style="font-size: 48px; color: #2ecc71; margin-bottom: 10px;"></i>
                                           <h3 style="margin:0; color: white;">${data.user}</h3>
                                           <p style="color: #2ecc71; font-weight: bold; margin: 5px 0 0;">Membership Active - Checked In</p>`;
                    resultDiv.style.background = 'rgba(46, 204, 113, 0.1)';
                    resultDiv.style.border = '1px solid rgba(46, 204, 113, 0.3)';
                } else {
                    resultDiv.innerHTML = `<i class="ph-fill ph-warning-circle" style="font-size: 48px; color: #f39c12; margin-bottom: 10px;"></i>
                                           <h3 style="margin:0; color: white;">${data.user}</h3>
                                           <p style="color: #f39c12; font-weight: bold; margin: 5px 0 0;">Membership Expired</p>`;
                    resultDiv.style.background = 'rgba(243, 156, 18, 0.1)';
                    resultDiv.style.border = '1px solid rgba(243, 156, 18, 0.3)';
                }
            } else {
                resultDiv.innerHTML = `<i class="ph-fill ph-x-circle" style="font-size: 48px; color: #e74c3c; margin-bottom: 10px;"></i>
                                       <p style="color: #e74c3c; font-weight: bold; margin: 0;">Invalid QR Code</p>`;
                resultDiv.style.background = 'rgba(231, 76, 60, 0.1)';
                resultDiv.style.border = '1px solid rgba(231, 76, 60, 0.3)';
            }
            
            // Resume scanning after 3 seconds
            setTimeout(() => {
                window.isScanning = false;
                resultDiv.innerHTML = '<i class="ph ph-qr-code" style="font-size: 48px; color: #666; margin-bottom: 10px;"></i><p style="color: #888; margin: 0;">Ready for next scan...</p>';
                resultDiv.style.background = 'rgba(0,0,0,0.2)';
                resultDiv.style.border = 'none';
            }, 3000);
        })
        .catch(err => {
            console.error(err);
            window.isScanning = false;
        });
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
