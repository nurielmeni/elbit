<div class="item-contact clearfix">	
    <div class="right-iframe">
        <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($location->post_excerpt) ?>" target="_blank"><img src="<?= get_the_post_thumbnail_url($location->ID) ?>" alt=" <?= $location->post_title ?> - לפתיחה במפה"></a>
    </div>
    <div class="location">
        <h4><a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($location->post_excerpt) ?>" target="_blank"><?= $location->post_title ?></a></h4>
        <p><a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($location->post_excerpt) ?>" target="_blank"><?= $location->post_excerpt ?></a></p>
        <?= apply_filters( 'the_content', $location->post_content) ?>
    </div>
</div>
