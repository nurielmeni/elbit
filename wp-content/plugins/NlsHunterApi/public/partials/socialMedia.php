<div class="nls-social">
    <?php if (strlen($nlsSocialMailTo) && strtolower($nlsSocialMailTo) !== "not-set") : ?>
        <a class="social mailto" target="_blank" href="mailto:<?= $nlsSocialMailTo ?>"></a>
    <?php endif; ?>
    <?php if (strlen($nlsSocialWeb) && strtolower($nlsSocialWeb) !== "not-set") : ?>
        <a class="social internet" target="_blank" href="<?= $nlsSocialWeb ?>"></a>
    <?php endif; ?>
    <?php if (strlen($nlsSocialInsta) && strtolower($nlsSocialInsta) !== "not-set") : ?>
        <a class="social instagram" target="_blank" href="<?= $nlsSocialInsta ?>"></a>
    <?php endif; ?>
    <?php if (strlen($nlsSocialIn) && strtolower($nlsSocialIn) !== "not-set") : ?>
        <a class="social linkedin" target="_blank" href="<?= $nlsSocialIn ?>"></a>
    <?php endif; ?>
    <?php if (strlen($nlsSocialFace) && strtolower($nlsSocialFace) !== "not-set") : ?>
        <a class="social facebook" target="_blank" href="<?= $nlsSocialFace ?>"></a>
    <?php endif; ?>
</div>
