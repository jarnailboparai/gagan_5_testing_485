
<h1 class="app_details_style">App Store Profile <br/><small>To complete this step please:</small></h1>
<div class="row">
		<div class="span11"><p><strong>Please follow these instructions:</strong></p><p>
1) Visit <a class="ctrl_style links_new" href="https://developer.apple.com/ios/manage/provisioningprofiles/viewDistributionProfiles.action">https://developer.apple.com/ios/manage/provisioningprofiles/viewDistributionProfiles.action</a><br>
						2) Click "New Profile"<br>
						3) Select "App Store"<br>
						4) Enter a name of your choice in the "Profile Name" box<br>
						5) From the "App ID" dropdown select "Wildcard" (If this option is not available please complete <a class="ctrl_style links_new" href="http://skybuilder.net/members/skycloud/iosUploads.php?stepId=2">these steps</a>)<br>
						6) Click "Submit"<br>
						7) Refresh the "Distribution Profiles" page<br>
						8) Download the newly created profile by clicking the "download" button<br>
						9) Upload the profile using the form below</p></div></div>
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
			
