<?php 
    include_once ABSPATH . 'wp-content/plugins/NlsHunterApi/renderFunction.php';
    $shareImagePath = '/wp-content/uploads/share/';
?>

<?= render('page-header', [
    'title' => $searchResultsTitle
]) ?>

<div class="job-content">
    <?= render('areas-filter', [
        'areas' => $areas
    ]) ?>
</div>

<?php if ($professionalFields) : ?>
<?= render('professionalFieldsTabs', [
    'professionalFields' => $professionalFields,
    'attribute' => 'professionalFields',
    'searchResultsUrl' => $searchResultsUrl
]); ?>
<?php endif; ?>
                            
<div class="box-presonal job-page">
    <?php if ($isMobile) : ?>
        <?php foreach ($jobs as $job) : ?>
            <?= render('jobMobile', [
                'job' => $job,
                'jobDetailsUrl' => $jobDetailsPageUrl . '?jobcode=' . $job['jobCode'],
                'model' => $this->model
            ]) ?>
        <?php endforeach; ?>
    <?php else : ?>
        <form>
            <table>
                <tr>
                    <th><?= __('Job Title', 'NlsHunterApi') ?></th>
                    <th class="col-span2"><?= __('Job Code', 'NlsHunterApi') ?></th>
                    <th class="col-span3"><?= __('Job Location', 'NlsHunterApi') ?></th>
                    <th><?= __('City', 'NlsHunterApi') ?></th>
                </tr>

                <?php foreach ($jobs as $job) : ?>
                    <?= render('job', [
                        'job' => $job,
                        'jobDetailsUrl' => $jobDetailsPageUrl . '?jobcode=' . $job['jobCode'],
                        'model' => $this->model
                    ]) ?>
                <?php endforeach; ?>

            </table>
        </form>
    <?php endif; ?>

    <?= render('pager', [
        'model' => $this->model,
        'jobs' => $jobs,
        'pagerPage' => $this->model->getPagerPage(),
        'offset' => $offset,
        'searchResultsUrl' => $searchResultsUrl,
    ]) ?>

    <div class="step-next pagenavis">
        <?php if (!$isMobile) : ?>
            <a href="#_" class="back-step submit-multi disabled"><?= __('Submit selected', 'NlsHunterApi') ?></a>
        <?php endif; ?>
        <a href="<?= $searchResultsUrl ?>" class="back-step">לכל המשרות ></a>
    </div>


</div>    

<script>
    // Used to set the url for the Job details page
    var jobDetailsPageUrl = "<?= $jobDetailsPageUrl ?>";
    
    // Used to set the selected options from the submited search form
    var setSelectedSumoOptions = <?= isset($search) ? json_encode($search) : '[]' ?>;

    // Used to set the search page url for the 'New Search Button'
    var searchPageUrl = "<?= isset($searchPageUrl) ? $searchPageUrl : null ?>";

    var resultsPagerPage = 1;
</script>