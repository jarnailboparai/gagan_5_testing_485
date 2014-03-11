<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'apple-profile-form',
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
		<?php echo $form->labelEx($model,'apple_email'); ?>
		<?php echo $form->textField($model,'apple_email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'apple_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_gap_key_title'); ?>
		<?php echo $form->textField($model,'phone_gap_key_title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'phone_gap_key_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apple_p12_password'); ?>
		<?php echo $form->textField($model,'apple_p12_password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'apple_p12_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p12_file'); ?>
		<?php echo $form->textField($model,'p12_file',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'p12_file'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'store_provisioning_profile'); ?>
		<?php echo $form->textField($model,'store_provisioning_profile',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'store_provisioning_profile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phonegap_id'); ?>
		<?php echo $form->textField($model,'phonegap_id'); ?>
		<?php echo $form->error($model,'phonegap_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
