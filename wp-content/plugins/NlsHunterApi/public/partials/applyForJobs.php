<div class="nls-apply-for-jobs modal" style="display: none;">
    <div class="modal-content nls-box-shadow">
        <div class="modal-header">
            <h1 class="title taas-title"><?= __('Submit CVs', 'NlsHunterApi') ?></h1>
        </div>
        <div class="modal-body send">
            <form name="nls-apply-for-jobs">
                <input type="file" name="browse" class="file-hidden-field" style="display: none;">
                <input type="hidden" name="jobIds" class="jobids-hidden-field">
                <input type="hidden" name="sid" class="sid-hidden-field" value="<?= $supplierId ?>">

                <!--  FILE NAME -->
                <div class="nls-apply-field browse">
                    <label for="fileName"><?= __('Append CV File', 'NlsHunterApi') ?></label>
                    <div class="flex">
                        <button class="browse"><?= __('Browse File', 'NlsHunterApi') ?></button>
                        <input 
                            type="text" 
                            name="fileName" 
                            readonly="readonly"
                            class="ltr" 
                            validator="required"
                            aria-invalid="false" 
                            aria-required="true">
                    </div>
                    <div class="help-block"></div>
                </div>   
                
                <!--  NAME -->
                <div class="nls-apply-field">
                    <label for="name"><?= __('Full Name', 'NlsHunterApi') ?></label>
                    <input 
                        type="text" 
                        name="name" 
                        validator="required"
                        class="" 
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>       

                <!--  ID -->
                <div class="nls-apply-field">
                    <label for="id"><?= __('ID', 'NlsHunterApi') ?></label>
                    <input 
                        type="text" 
                        name="id" 
                        validator="required ISRID"
                        class="ltr" 
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>   
                
                <!--  CELL PHONE -->
                <div class="nls-apply-field">
                    <label for="cell"><?= __('Cell', 'NlsHunterApi') ?></label>
                    <input 
                        type="tel" 
                        name="cell" 
                        class="ltr" 
                        validator="required phone"
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>   
                
                <!--  EMAIL -->
                <div class="nls-apply-field">
                    <label for="email"><?= __('email', 'NlsHunterApi') ?></label>
                    <input 
                        type="email" 
                        name="email" 
                        validator="required email"
                        class="ltr" 
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>       
                
                <!--  CITY -->
                <div class="nls-apply-field">
                    <div class="label-wrapper flex space-between">
                        <label for="city"><?= __('City', 'NlsHunterApi') ?></label>
                        <span class="small-text"><?= __('(Optional)', 'NlsHunterApi') ?></span>
                    </div>
                    <input 
                        type="text" 
                        name="city" 
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>   

                <!--  ANOTHER CITIZENSHIP -->
                <div class="nls-apply-field">
                    <label><?= __('Another citizenship', 'NlsHunterApi') ?></label>
                    <div class="options-wrapper">
                        <div class="radio-option">
                            <input id="citizenshipYes" type="radio" name="is-citizenship" value="yes" validator="radioRequired">
                            <label for="citizenshipYes"><?= __('Yes', 'NlsHunterApi') ?></label>
                        </div>
                        <div class="radio-option">
                            <input id="citizenshipNo" type="radio" name="is-citizenship" value="no">
                            <label for="citizenshipNo"><?= __('No', 'NlsHunterApi') ?></label>
                        </div>
                    </div>
                    <div class="help-block"></div>
                </div>                    
                
                <!--  CITIZENSHIP -->
                <div class="nls-apply-field is-citizenship-show">
                    <label for="citizenship"><?= __('Citizenship type', 'NlsHunterApi') ?></label>
                    <input 
                        type="text" 
                        name="citizenship" 
                        class="" 
                        validator="required"
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>       

                <!--  STRONG SIDE -->
                <div class="nls-apply-field options select">
                    <?= __('My strong side is...', 'NlsHunterApi') ?>
                    <?= NlsHelper::htmlSelect("strongSide", "nls-search strongSide", false, $myStrongSide, __('My strong side', 'NlsHunterApi')) ?>
                    <div class="nls-validation"></div>
                </div>

                <!--  IS STUDENT -->
                <div class="nls-apply-field">
                    <label><?= __('Is student', 'NlsHunterApi') ?></label>
                    <div class="options-wrapper">
                        <div class="radio-option">
                            <input id="studentYes" type="radio" name="student" value="yes" validator="radioRequired">
                            <label for="studentYes"><?= __('Yes', 'NlsHunterApi') ?></label>
                        </div>
                        <div class="radio-option">
                            <input id="studentNo" type="radio" name="student" value="no">
                            <label for="studentNo"><?= __('No', 'NlsHunterApi') ?></label>
                        </div>
                    </div>
                    <div class="help-block"></div>
                </div>                    
                
                <!--  DATE DEGREE -->
                <div class="nls-apply-field student-show">
                    <label for="date-degree"><?= __('Date of completion', 'NlsHunterApi') ?></label>
                    <input 
                        type="date" 
                        name="date-degree" 
                        class="" 
                        validator="required"
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>       

                <!--  AVARAGE -->
                <div class="nls-apply-field student-show width-50">
                    <label for="avarage"><?= __('Avarage', 'NlsHunterApi') ?></label>
                    <input 
                        type="number" 
                        name="avarage"  
                        min="0" max="100" 
                        class="" 
                        validator="required"
                        aria-invalid="false" 
                        aria-required="true">
                    <div class="help-block"></div>
                </div>       

                <!--  RELATIVE -->
                <div class="nls-apply-field">
                    <label><?= __('Relatives in the company?', 'NlsHunterApi') ?></label>
                    <div class="options-wrapper" validator="required">
                        <div class="radio-option">
                            <input id="relativeYes" type="radio" name="relative" value="yes" validator="radioRequired">
                            <label for="relativeYes"><?= __('Yes', 'NlsHunterApi') ?></label>
                        </div>
                        <div class="radio-option">
                            <input id="relativeNo" type="radio" name="relative" value="no">
                            <label for="relativeNo"><?= __('No', 'NlsHunterApi') ?></label>
                        </div>
                    </div>
                    <div class="help-block"></div>
                </div>      

                <!--  RELATION -->
                <div class="nls-apply-field relative-show">
                    <label for="relation"><?= __('Relation', 'NlsHunterApi') ?></label>
                    <input 
                    type="text" 
                    name="relation" 
                    class=""                  
                    validator="required"
                    aria-invalid="false" 
                    aria-required="true">
                    <div class="help-block"></div>
                </div>       
            </form>
        </div>
        <div class="modal-footer send">
            <p class="disclaimer"><?= __('* To your attention, in accordance with the govermental companies (ruls regarding relatives employment), 2005, applicant with relatives employee, will be examined.', 'NlsHunterApi') ?></p>
            <p class="approval"><?= __('By applying, you agree to recieve updates/messages regarding recruiments to IAI', 'NlsHunterApi') ?></p>
            <button class="apply-cv nls-btn"><?= __('Submit CV', 'NlsHunterApi') ?></button>
            <div class="help-block">
                
            </div>
        </div>
    </div>
</div>