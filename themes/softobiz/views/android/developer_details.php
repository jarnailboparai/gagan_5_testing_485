<div class="span11_1">
<h1 class="app_details_style" style="margin-left:0;">Android Developer Details <br/>
    <small>The information entered below must match exactly the details in your Android developer account.</small></h1>

<div >
    <div>
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

            <div class="">
                <?php echo $form->labelEx($model, 'android_keystore_name'); ?>
                <?php echo $form->textField($model, 'android_keystore_name'); ?>
                <?php echo $form->error($model, 'android_keystore_name'); ?>
            </div>

            <div class="">
                <?php echo $form->labelEx($model, 'android_keystore_password'); ?>
                <?php echo $form->passwordField($model, 'android_keystore_password'); ?>
                <?php echo $form->error($model, 'android_keystore_password'); ?>
            </div>
            <div class=" buttons">		
                <?php echo CHtml::submitButton('Save & Continue', array('class' => 'btn btn-primary btn-large')); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>
</div> <!-- form -->
</div>
