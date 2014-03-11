<?php
    //$this->renderPartial("app_menu", array('style'=>$style));
?>

<div class="body_right">
<h1 class="app_details_style">
	Splash Screen <br/>
	<span>
		The following information will appear on your app's initial launch page. 
		<br/>Call, Email, and directions are provided for SMB apps.
	</span>
</h1>
	<div class="span12">
		<?php 
			 $form=$this->beginWidget('CActiveForm', array(
					 'id'=>'splash-form',
					 'enableAjaxValidation'=>false,
					 'htmlOptions' => array(
							 'enctype' => 'multipart/form-data',
							 'class' => 'form-horizontal',
						 ),
			 )); 
		 ?>
		<fieldset>

		<div class="control-group">
			<label class="control-label ctrl_style">Launch Tab Title</label>
			<div class="controls">
				<?php echo $form->textField($model,'launch_tab_title',array('class'=>'span5','placeholder'=>'Enter A Title For Your Launch Tab','id'=>'launchTabTitle')); ?>
				<?php echo $form->error($model,'launch_tab_title'); ?>
			</div>
		</div>
			
		<div class="control-group">
				<label class="control-label">Call Us</label>
				<div class="controls">
					<?php echo $form->textField($model,'phone',array('class'=>'span5','placeholder'=>'Enter A Phone Number To Add A \'Click To Call\' Button','id'=>'indexPhoneNumber')); ?>
				</div>
		</div>

		<div class="control-group">
			<label class="control-label">Email Us</label>
			<div class="controls">
				<?php echo $form->textField($model,'email',array('class'=>'span5','placeholder'=>'Enter A Phone Number To Add A \'Click To Email\' Button','id'=>'indexPhoneNumber')); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Directions</label>
			<div class="controls">
				<?php echo $form->textField($model,'address',array('class'=>'span5','placeholder'=>'Enter A Phone Number To Add A \'Directions\' Button','id'=>'indexDirection')); ?>
			</div>
		 </div>
			
		<div class="control-group">
			<label class="control-label ctrl_style">Launch Image (640x861)</label>
			<div class="controls">
				<?php echo $form->fileField($model,'launch_image',array('class'=>'input-file','id'=>'launchimage')); ?>
				<?php echo $form->error($model, 'launch_image'); ?>

				<p class="help-block">Please upload a 640x861 PNG image to avoid distortion.</p>
			</div>
		</div>	

		<div class="control-group">
			<label class="control-label ctrl_style">Launch Image Preview</label>
			<div class="controls">
				<ul class="thumbnails">
					<li class="">
						<?php
						  if ($model->launch_image=='')
							$image = Yii::app()->theme->baseUrl."/images/-wizard2.png";
						  else
							$image = Yii::app()->baseUrl."/app_images/".$model->launch_image;
						?>
						<div class="thumbnail"><img src="<?php echo $image; ?>" style="height: 350px;" /></div>
					</li>
				 </ul>
			</div>
			
			<div class="form-actions continue_button">
				<?php echo CHtml::submitButton('Save & Continue',array('class'=>'btn btn-primary btn-large')); ?>
			</div>
		</div>

		</fieldset>
	
        <?php $this->endWidget(); ?>
    </div>
</div>
