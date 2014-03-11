<h1 class="app_details_style">Android Developer Details <br/>
    <small>The information entered below must match exactly the details in your Android developer account.</small></h1>

<div class="row">
    <div class="span11">
        <div class="form">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'android-profile-view-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
            ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model); ?>

            <div class="row">
                <?php echo $form->labelEx($model, 'android_keystore_name'); ?>
                <?php echo $form->textField($model, 'android_keystore_name'); ?>
                <?php echo $form->error($model, 'android_keystore_name'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'android_keystore_password'); ?>
                <?php echo $form->passwordField($model, 'android_keystore_password'); ?>
                <?php echo $form->error($model, 'android_keystore_password'); ?>
            </div>
            <div class="row buttons">		
                <?php echo CHtml::submitButton('Save & Continue', array('class' => 'btn btn-primary btn-large')); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>
</div> <!-- form -->
