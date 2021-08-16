<?php 
    include_once ABSPATH . 'wp-content/plugins/NlsHunterApi/renderFunction.php';
    $shareImagePath = wp_upload_dir()['baseurl'] . '/share/';
?>
<div class="banner">
    <img src="<?= $bannerImage ?>" alt="Banner Job">
</div>
<div class="main-content">
    <div class="container">
        <?= render('page-header', [
            'title' => $job['jobTitle']
        ]) ?>
        
        <div class="job-code">
            <?php if (!empty($job['jobCode'])) : ?>
                <span><b><?= __('Job Code', 'NlsHunterApi') ?>: </b><?= $job['jobCode'] ?></span> 
            <?php endif; ?>
            <?php if (!empty($job['regionText'])) : ?>
                <span><b><?= __('Job Location', 'NlsHunterApi') ?>: </b><?= $job['regionText'] ?></span>  
            <?php endif; ?>
            <?php if (!empty($job['regionText'])) : ?>
                <span><b><?= __('City', 'NlsHunterApi') ?>: </b><?= (key_exists('cityName', $job) && !empty($job['cityName'])) ? $job['cityName'] : '' ?></span>
            <?php endif; ?>
        </div>

        <?= render('content-job', [
            'jobDetails' => $jobDetails
        ]) ?>


        <div class="info-job">	
            <a href="<?= $referer ?>" class="nls-btn submit-cv back-step"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?= __('Back to search results', 'NlsHunterApi') ?> </a>
            <a href="#" jobcode="<?= $job['jobCode'] ?>" class="back-step apply-job"><?= __('Submit CV', 'NlsHunterApi') ?>> </a>
        </div>
        <div class="info-job">	
                    <?= render('social-job', [
                'jobTitle' => $job['jobTitle'],
                'url' => $jobDetailsPageUrl . '?jobcode=' . $job['jobCode']
            ]) ?>
        </div>

    </div>
</div>