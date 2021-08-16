
<div class="item-people">
    <img src="<?= $image ?>" alt="<?= $people->title ?>">
    <div class="inner-people">
        <h3><span class="title"><?= $people->post_title ?></span></h3>
        <span><?= strip_tags($people->post_content) ?></span>
        <p><?= $people->post_excerpt ?></p>
    </div>
</div>
