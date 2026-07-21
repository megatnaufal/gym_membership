<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="flash-banner flash-success" onclick="this.style.display='none'" role="alert">
    <span class="flash-icon"><i class="ph-fill ph-check-circle"></i></span>
    <span class="flash-msg"><?= $message ?></span>
    <button class="flash-close" onclick="this.parentElement.style.display='none'" aria-label="Dismiss">&times;</button>
</div>
