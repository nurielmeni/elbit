<div class="job-wraper flex space-between align-center">
    <a href="<?= $jobDetailsUrl ?>">
        <div class="details flex column">
            <?php if (!empty($job['jobTitle'])) : ?>
                <span><?= $job['jobTitle'] ?></span>
            <?php endif; ?>
            <?php if (!empty($job['jobCode'])) : ?>
                <span><b><?= __('Job Code', 'NlsHunterApi') ?>: </b><?= $job['jobCode'] ?></span>
            <?php endif; ?>
            <?php if (!empty($job['regionText'])) : ?>
                <span><b><?= __('Job Location', 'NlsHunterApi') ?>: </b><?= $job['regionText'] ?></span>
            <?php endif; ?>
            <?php if (!empty($job['cityName'])) : ?>
                <span><b><?= __('City', 'NlsHunterApi') ?>: </b><?= (key_exists('cityName', $job) && !empty($job['cityName'])) ? $job['cityName'] : '' ?></span>
            <?php endif; ?>
        </div>
    </a>
    <div class="flex align-center">
        <a href="#" class="btn-table download" jobcode="<?= $job['jobCode'] ?>">הגשת קו"ח &gt;</a>
        <i class="toggle fa fa-ellipsis-v" aria-hidden="true"></i>
    </div>
</div>