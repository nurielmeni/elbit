<div id="modal-wrapper" class="nls-apply-for-jobs modal" role="dialog" aria-modal="true" style="display: none;">
    <div class="modal-backdrop"></div>
    <div class="modal-popup">
        <div role="button" tabindex="0" class="close-popup"><img src="<?= wp_upload_dir()['baseurl'] . '/images/close.png' ?>" alt="סגור"></div>
        <div class="inner-popup apply-response" style="display: none;">
            <h2><?= __('Send cv', 'NlsHunterApi') ?></h2>
            <br/>
            <p><?= __('Cv subbmited successfully', 'NlsHunterApi') ?><br/><?= __('Thenk you for your request', 'NlsHunterApi')?></p> <!-- קורות החיים הוגשו בהצלחה.<br/>תודה על פנייתך. -->
            <a href="#" class="back-step"><i class="fa fa-long-arrow-right" aria-hidden="true"></i><?= __('Back', 'NlsHunterApi') ?>  </a>
        </div>
        <div class="inner-popup apply-form" style="display: none;">
            <h2><?= __('Send cv', 'NlsHunterApi') ?></h2>
            <p><?= __('All the fileds are required', 'NlsHunterApi') ?></p>
            <form name="nls-apply-for-jobs" action="/">
                <input type="hidden" name="jobIds" class="jobids-hidden-field">
                <input type="hidden" name="sid" class="sid-hidden-field" value="<?= $supplierId ?>">
                <div class="nls-apply-field">
                    <label for="name"><?= __('Full name', 'NlsHunterApi') ?></label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        placeholder="שם מלא" 
                        aria-invalid="false" 
                        aria-required="true"
                        validator="required">
                    <div class="help-block"></div>
                </div>
                <div class="nls-apply-field">
                    <label for="id-number"></label>
                    <input 
                        type="text" 
                        name="idnumber" 
                        id="id-number" 
                        aria-invalid="false" 
                        aria-required="true"
                        validator="required ISRID"
                        placeholder="מספר תעודת זהות">
                    <div class="help-block"></div>
                </div>
                <div class="nls-apply-field file-form">
                    <label role="button" tabindex="0" class="file" for="file"><?= __('File select', 'NlsHunterApi') ?></label>
                    <input 
                        type="file" 
                        class="inputfile" 
                        name="file" 
                        id="file" 
                        tabindex="-1"
                        aria-invalid="false" 
                        aria-required="true"
                        validator="required"
                        placeholder="">
                    <div class="file-option flex column">
                        <div><?= __('File not selected', 'NlsHunterApi') ?></div>
                        <div><?= __('recomended files:', 'NlsHunterApi') ?></div>
                        doc / docx / pdf
                    </div>
                    <div class="help-block"></div>
                </div>

                <div class="modal-footer send">
                    <button type="button" class="apply-cv"><?= __('Send Cv', 'NlsHunterApi') ?></button>
                    <div class="help-block">
                        <p><span><?= __('Form error. Check the submited data.', 'NlsHunterApi') ?></span></p>
                    </div>
                </div>
            </form>
        </div>
    </div>	
</div>
