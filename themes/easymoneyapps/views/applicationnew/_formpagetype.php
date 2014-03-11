<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'module-forms',
	'action'=> CHtml::normalizeUrl(array('applicationnew/selectPage')),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'id'); ?>
		
	</div>

	<div class="row">
		<?php $data = array('0'=>'select','1'=>'Single Page','2'=>'Multiple page'); echo $form->labelEx($model,'page_type'); ?>
		<?php echo $form->dropDownList($model,'page_type',$data,array()); ?>
		
		<?php echo $form->error($model,'page_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
