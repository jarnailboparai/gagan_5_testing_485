

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'apple-profile-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('name'=>'themeForm','enctype'=> 'multipart/form-data')
)); ?>

	<p class="note"><span class="required">Fields with * are required.</span></p>

	<?php echo $form->errorSummary($model); ?>
	
    	<?php //echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->hiddenField($model,'user_id',array('value'=>Yii::app()->user->id)); ?>
		<?php //echo $form->error($model,'user_id'); ?>
	
<label for="">Title</label>
<input type="text" name="" maxlength="100" size="60">
	<label for="">Select App</label>
<select><option>MicroSoft</option><option>Apple</option></select>
		<?php echo $form->labelEx($model,'apple_email'); ?>
		<?php echo $form->textField($model,'apple_email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'apple_email'); ?>

		<?php echo $form->labelEx($model,'phone_gap_key_title'); ?>
		<?php echo $form->textField($model,'phone_gap_key_title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'phone_gap_key_title'); ?>

		<?php echo $form->labelEx($model,'apple_p12_password'); ?>
		<?php echo $form->textField($model,'apple_p12_password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'apple_p12_password'); ?>
	

	<div class="row-fluid">
    <div class="span6">
		<?php echo $form->labelEx($model,'p12_file'); ?>
		<?php echo $form->fileField($model,'p12_file',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'p12_file'); ?>
        </div>
	<div class="span6">
    <?php echo $form->labelEx($model,'store_provisioning_profile'); ?>
		<?php echo $form->fileField($model,'store_provisioning_profile',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'store_provisioning_profile'); ?>
    </div>
    </div>

	

		<?php //echo $form->labelEx($model,'phonegap_id'); ?>
		<?php echo $form->hiddenField($model,'phonegap_id',array('value'=>'0')); ?>
		<?php //echo $form->error($model,'phonegap_id'); ?>
	

	
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-success')); ?><input type="button" value="Cancel" name="yt0" class="btn apple_form_btn">
	

<?php $this->endWidget(); ?>

<!-- form -->
