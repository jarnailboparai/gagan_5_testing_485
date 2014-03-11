<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'applink-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'application_id'); ?>
		<?php echo $form->textField($model,'application_id'); ?>
		<?php echo $form->error($model,'application_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phonegap_id'); ?>
		<?php echo $form->textField($model,'phonegap_id'); ?>
		<?php echo $form->error($model,'phonegap_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'android'); ?>
		<?php echo $form->textArea($model,'android',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'android'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ios'); ?>
		<?php echo $form->textArea($model,'ios',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ios'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
