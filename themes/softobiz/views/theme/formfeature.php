<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'menu'); ?>
		<?php echo $form->dropDownList($model,'menu',array('1'=>'left side','2'=>'right side','3'=>'one row',
															'4'=>'two rows','5'=>'three rows')); ?>
		<?php echo $form->error($model,'menu'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
