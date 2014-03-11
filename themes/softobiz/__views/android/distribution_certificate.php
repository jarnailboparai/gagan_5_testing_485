
<div id="certificate_wrapper">
    <h1 class="app_details_style">Distribution Certificate <br/><small>To complete this step please:</small></h1>
    <div class="row">
        <div class="span11"><p><strong>Please follow these instructions:</strong></p><p>STEPS TO FOLLOW GOES HERE</p>
            <p>Apple will then provide a Distribution Certificate that can be downloaded from their portal. This Distribution Certificate needs to be uploaded below.</p></div></div>
    <h1 class="app_details_style">Upload Distribution Certificate <br/><small>Please upload the Distribution Certificate that the Apple Dev Portal provided.</small></h1>
    <div class="row">
        <div class="span11">            
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'user-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
            ?>
            <fieldset>

                <div class="control-group">
                    <label class="control-label">Distribution Certificate</label>
                    <div class="controls">

                        <?php echo $form->fileField($model, 'android_file_keystore', array('class' => 'input-file', 'id' => 'uploadedFile')); ?>
                        <?php echo $form->error($model, 'android_file_keystore'); ?>
                    </div>
                </div>

                <div class="form-actions">

                    <?php echo CHtml::submitButton('Upload', array('class' => 'btn btn-primary btn-large')); ?>
                </div>

            </fieldset>
            <?php $this->endWidget(); ?>
        </div></div>
</div>
