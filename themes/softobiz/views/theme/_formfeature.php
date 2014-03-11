<div class="form">

<?php $form=$this->beginWidget('CActiveForm');  //$form->s ?>

	<?php /*  <p class="note">Fields with <span class="required">*</span> are required.</p> */ ?>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row" style="display:none;">
		<?php //echo $form->labelEx($model,'feature'); ?>
		<?php echo $form->checkBoxList($model,'feature',$data); ?>
		<?php //echo $form->error($model,'feature'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
