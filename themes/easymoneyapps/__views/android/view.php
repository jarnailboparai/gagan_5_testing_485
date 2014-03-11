<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'android-profile-view-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phonegap_id'); ?>
		<?php echo $form->textField($model,'phonegap_id'); ?>
		<?php echo $form->error($model,'phonegap_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'android_keystore_name'); ?>
		<?php echo $form->textField($model,'android_keystore_name'); ?>
		<?php echo $form->error($model,'android_keystore_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'android_keystore_alias'); ?>
		<?php echo $form->textField($model,'android_keystore_alias'); ?>
		<?php echo $form->error($model,'android_keystore_alias'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'android_keystore_password'); ?>
		<?php echo $form->textField($model,'android_keystore_password'); ?>
		<?php echo $form->error($model,'android_keystore_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'android_keystore_alias_password'); ?>
		<?php echo $form->textField($model,'android_keystore_alias_password'); ?>
		<?php echo $form->error($model,'android_keystore_alias_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'android_file_keystore'); ?>
		<?php echo $form->textField($model,'android_file_keystore'); ?>
		<?php echo $form->error($model,'android_file_keystore'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
