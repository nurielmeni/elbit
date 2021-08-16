<div class="banner">
    <img src="images/banner.jpg" alt="Banner">
    <div class="container">
        <h1><?= __('Endless opportunities in Elbit', 'NlsHunterApi') ?></h1>
        <form name="nls-search" class="nls-search" method="get" action="<?= $searchResultsUrl ?>">
            <label for="search">search</label>
            <input id="search" type="text" name="keywords" placeholder="<?= __('To your next opportunity', 'NlsHunterApi') ?>" autofocus>
            <button aria-label="search" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
    </div>
</div>
