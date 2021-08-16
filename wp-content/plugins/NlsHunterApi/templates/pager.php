<div class="nls-pager">
    <div class="pagenavi">

        <a href="<?= $model->getPagerUrl(0) ?>" <?= $model->getPagerData($jobs, $offset, false, 'next-steps') ?>><?= __('Prev', 'NlsHunterApi') ?></a>
        <a href="<?= $model->getPagerUrl(-1) ?>" <?= $model->getPagerData($jobs, $offset, true, 'back-steps') ?>><?= __('Next', 'NlsHunterApi') ?></a>

    </div>
</div>
