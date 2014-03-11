
<div id="provisioning_certificate_wrapper">
<h1 class="app_details_style">App Store Profile</h1>
<h1 class="app_details_style">Upload App Store Provisioning Profile <br/><small>Please upload the App Store Provisioning Profile that the Apple Dev Portal provided.</small></h1>
<div class="row">
		<div class="span11">
				
<!--				<form class="form-horizontal" id="form" action="http://skybuilder.net/members/skycloud/iosUploadHandler.php" method="post" autocomplete="off" enctype="multipart/form-data">-->
<?php 
    $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); 
?>
					<fieldset>
					
					<div class="control-group">
			        <label class="control-label">App Store Provisioning Profile</label>
			            <div class="controls">
<!--			              <input class="input-file" id="uploadedfile" name="uploadedfile" type="file">-->
                                        <?php echo $form->fileField($model,'store_provisioning_profile',array('class'=>'input-file','id'=>'uploadedFile')); ?>
                                        <?php echo $form->error($model, 'store_provisioning_profile'); ?>
			            </div>
			     </div>
						
		<input type="hidden" name="submitted" value="1">
		<input type="hidden" name="userId" value="1145293011501fbcecc86544.18190566">
		<input type="hidden" name="stepId" value="3">

<div class="form-actions">
<!--					 	<button type="submit" class="btn btn-primary btn-large">Upload</button>-->
<?php echo CHtml::submitButton('Upload',array('class'=>'btn btn-primary btn-large')); ?>
					 </div>

			</fieldset>
<!--</form>-->
<?php $this->endWidget(); ?>
                </div></div>
			
</div>
