<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>



	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'theme'); ?>
		<?php echo $form->textField($model,'theme',array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'theme_id'); ?>
		<?php echo $form->textField($model,'theme_id',array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'theme_id'); ?>
	
	</div>
	
	
		<div class="row">
		<?php //echo $form->labelEx($model,'theme'); ?>
		<?php echo $form->hiddenField($model,'name',array('size'=>80,'maxlength'=>128,'value'=>'mytest')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'theme_id'); ?>
		<?php echo $form->hiddenField($model,'appid',array('size'=>80,'maxlength'=>128,'value'=>'test.id.com')); ?>
		<?php echo $form->error($model,'theme_id'); ?>
	
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
		
<?php //echo $this->renderPartial('_formfeature', array('model'=>$model)); ?>		
