<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'video-files-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'actual_url'); ?>
		<?php echo $form->textField($model,'actual_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'actual_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mp4_url'); ?>
		<?php echo $form->textField($model,'mp4_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mp4_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'threegp_url'); ?>
		<?php echo $form->textField($model,'threegp_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'threegp_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'m4v'); ?>
		<?php echo $form->textField($model,'m4v',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'m4v'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'thumbnail_url'); ?>
		<?php echo $form->textField($model,'thumbnail_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'thumbnail_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated'); ?>
		<?php echo $form->textField($model,'updated'); ?>
		<?php echo $form->error($model,'updated'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
