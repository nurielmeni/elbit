<div class="social-job">
    <span>שיתוף המשרה:</span>
    <ul>
        <li>
            <a 
                target="_blank" 
                aria-label="linkedin" 
                href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode($url) ?>">
                <i class="fa fa-linkedin-square" aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a 
                target="_blank" 
                aria-label="twitter" 
                class="whatsapp twitter-share-button" 
                href="https://twitter.com/intent/tweet?url=<?= urlencode($url) ?>">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a 
                target="_blank" 
                aria-label="facebook" 
                class="face" 
                href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($url) ?>">
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a 
                target="_blank" 
                aria-label="whatsapp"  
                href="https://api.whatsapp.com/send?text=<?= urlencode($url . "\n\r") . "\n\rמצאתי משרה שתיקח אותך הכי גבוה שאפשר\n\r" ?>">
                <i class="fa fa-whatsapp" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
</div>
