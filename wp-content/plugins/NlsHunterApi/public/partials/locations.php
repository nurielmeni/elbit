<?php
    require_once ABSPATH . 'wp-content/plugins/NlsHunterApi/includes/Hunter/NlsHelper.php';
    require_once ABSPATH . 'wp-content/plugins/NlsHunterApi/renderFunction.php';
?>

<div class="our-contact">
    <div class="container">
        <h2 class="subtitle">דרכי הגעה</h2>
        <div class="list-contact">

            <?php foreach($locations as $location) : ?>
                <?= render('location', [
                    'location' => $location,
                ]) ?>
            <?php endforeach; ?>
            
            <?php if($max > -1 && count($locations) >= $max) : ?>
                <div class="item-contact">	
                    <div class="link-all">
                        <a href="#_">לכל המיקומים &gt;</a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
