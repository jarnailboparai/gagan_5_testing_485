
<div id="certificate_wrapper">
    <h1 class="app_details_style">Distribution Certificate <br/><small>To complete this step please:</small></h1>
    <div class="row">
        <div class="span11"><p><strong>Please follow these instructions:</strong></p><p>
                1) Right click <a class="ctrl_style links_new" href="<?php  ?>">here and choose "Save Link As" to download your Certificate Signing Request</a><br>
                2) Visit <a class="ctrl_style links_new" href="https://developer.apple.com/ios/manage/certificates/team/distribute.action">https://developer.apple.com/ios/manage/certificates/team/distribute.action</a><br>
                3) Click the "Request Certificate" button<br>
                4) Upload the Certificate Signing Request (that was downloaded in step 1)
            </p>
            <p>Apple will then provide a Distribution Certificate that can be downloaded from their portal. This Distribution Certificate needs to be uploaded below.</p></div></div>
    <h1 class="app_details_style">Upload Distribution Certificate <br/><small>Please upload the Distribution Certificate that the Apple Dev Portal provided.</small></h1>
    <div class="row">
        <div class="span11">

            <!--                    <form class="form-horizontal" id="form" action="http://skybuilder.net/members/skycloud/iosUploadHandler.php" method="post" autocomplete="off" enctype="multipart/form-data">-->
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'user-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
            ?>
            <fieldset>

                <div class="control-group">
                    <label class="control-label">Distribution P12 Certificate</label>
                    <div class="controls">
<!--                          <input class="input-file" id="uploadedfile" name="uploadedfile" type="file">-->
                        <?php echo $form->fileField($model, 'p12_file', array('class' => 'input-file', 'id' => 'uploadedFile')); ?>
                        <?php echo $form->error($model, 'p12_file'); ?>
                    </div>
                </div>

                <div class="form-actions">
                    <!--                                    <button type="submit" class="btn btn-primary btn-large">Upload</button>-->
                    <?php echo CHtml::submitButton('Upload', array('class' => 'btn btn-primary btn-large')); ?>
                </div>

            </fieldset>
            <?php $this->endWidget(); ?>
        </div></div>
</div>
