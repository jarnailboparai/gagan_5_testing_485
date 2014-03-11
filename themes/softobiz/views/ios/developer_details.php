<h1 class="app_details_style">Apple Developer Details <br/>
<small>The information entered below must match exactly the details in your Apple developer account.</small></h1>

<div class="row">
<div class="span11">



<!--                <form class="form-horizontal" action="./ios setup 0_files/ios setup 0.htm" method="post" autocomplete="off" enctype="multipart/form-data">-->
<?php 
    $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); 
?>
        <fieldset>



                                <div class="control-group">
                                    <label class="control-label">Email Address</label>
                                    <div class="controls">
<!--                                    <input type="text" class="span5" id="appleDevEmail" name="appleDevEmail" value="Pnealey4@gmail.com"></div>-->
                                        <?php echo $form->textField($model, 'apple_email', array('class'=>'span5')); ?>
                                        <?php echo $form->error($model,'apple_email'); ?>
                                </div>


<!--                                <div class="control-group">
                <label class="control-label">iOS Dev Center Password</label>
                    <div class="controls">
                      <input type="password" class="span5" id="appleDevPass" name="appleDevPass" value="Gators08"></div>
                                </div>-->


                                <div class="control-group">
                                    <label class="control-label">Key title</label>
                                    <div class="controls">
<!--                                    <input type="text" class="span5" id="appleDevName" name="appleDevName" value="Phil Nealey"></div>-->
                                    <?php echo $form->textField($model,'phone_gap_key_title',array('class'=>'span5')); ?>
                                    <?php echo $form->error($model,'phone_gap_key_title'); ?>
                                </div>
                                    
                                <div class="control-group">
                                    <label class="control-label">apple_p12_password</label>
                                    <div class="controls">
                                    <?php echo $form->passwordField($model,'apple_p12_password',array('class'=>'span5')); ?>
                                    <?php echo $form->error($model,'apple_p12_password'); ?>
                                </div>


                                <div class="control-group">



                 <input type="hidden" id="submitted" name="submitted" value="1">
             <div class="form-actions">
<!--                        <button type="submit" class="btn btn-primary btn-large">Save &amp; Continue</button>-->
                            <?php echo CHtml::submitButton('Save & Continue',array('class'=>'btn btn-primary btn-large')); ?>
                  <!---  <button type="submit" class="btn btn-large">Cancel</button> -->
                 </div>

         </div></fieldset>
<!-- </form>-->
<?php $this->endWidget(); ?>
 </div>
 </div>
