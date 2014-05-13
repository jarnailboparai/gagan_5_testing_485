<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/edit_detail.js"></script>
<?php $pathurl = Yii::app()->theme->baseUrl; ?>
<link href="<?php echo $pathurl; ?>/css/icons.css" rel="stylesheet" type="text/css"></link>
<?php

$pathurl = Yii::app()->theme->baseUrl;
// if (isset($disabled))
//     $this->renderPartial("app_menu", array('style' => $style, 'disabled' => $disabled));
// else
//     $this->renderPartial("app_menu", array('style' => $style));
?>
<div class="fixed_top">
<?php echo $this->renderPartial('/applicationnew/_custom_setting',array('id'=>$model->id,'data'=>array('formId'=>'user-form','tabselect'=>'select_info'))); ?>	
<button onclick="submitForm();" class="btn btn-large pull-right save update_theme" type="button"><span>Update App Info</span></button>
</div>
<?php if (Yii::app()->user->hasFlash('create_app_error')): ?>
    <div class="errorMessage"><?php //echo Yii::app()->user->getFlash('create_app_error'); ?></div>
<?php endif; ?>

<!-- <div class="body_right"> -->
   
<!--     <div class="span7 formstyle01"> -->
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => false,
			//'action' => '?r=applicationnew/details',
            'htmlOptions' => array('enctype' => 'multipart/form-data','name'=>'user-form','class'=>'form-signin edit_appdetail',"onsubmit"=>"user_valid_app()"),
                ));
        ?>
         <h4 class="form-signin-heading">
    	App Details  Check deploy<br/>
    </h4>
        <fieldset>
            <div class="control-group">
                <label class="control-label ctrl_style" style="width:100%;float:left;"><span style="float:left;margin-right:10px;">App Title</span><span style="float:left;"><a href="#" class="eeee" data-toggle="tooltip" data-placement="right" title="" data-original-title="This will the title of application.Note: App Title space and special characters(@#$%^) not allowed."><img src="<?= $pathurl?>/img/app_info_icon.png" ></a></span></label>
                <div class="controls">
                    <?php echo $form->textField($model, 'title', array('placeholder' => 'Enter Your App name', 'id' => 'appTitle', 'class' => 'span5','disabled'=>true)); ?>
                    <?php echo $form->error($model, 'title',array('class'=>'alert alert-error')); ?>
<!--                     <span class="help-block">Please use Alphanumeric characters . Special characters such as &amp;, *,$, spaces etc are not possible in your App Title.</span> -->
                </div>
            </div>
     <div class="control-group">
<!--                 <label class="control-label ctrl_style">App Id</label>   -->
                <label class="control-label ctrl_style" style="width:100%;float:left;"><span style="float:left;margin-right:10px;">App Id</span><span style="float:left;"><a href="#" class="eeee" data-toggle="tooltip" data-placement="right" title="" data-original-title="Please use com.example.type"><img src="<?= $pathurl?>/img/app_info_icon.png" ></a></span></label>             
                 <?php 
				 $arr = '';
				 if(isset($disable_app) && $disable_app == 'disabled' )
				 	$arr = 'disabled';
				 ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'id_app', array('placeholder' => 'Enter Your App id', 'id' => 'appId', 'class' => 'span5','disabled'=>true )); ?>
                    <?php echo $form->error($model, 'id_app',array('class'=>'alert alert-error')); ?>
<!--                     <span class="help-block">Please use com.example.type .</span> -->
                </div>
            </div>
            <div class="control-group">
                 <label class="control-label ctrl_style" style="width:100%;float:left;"><span style="float:left;margin-right:10px;">App Description</span><span style="float:left;"><a href="#" class="eeee" data-toggle="tooltip" data-placement="right" title="" data-original-title="This will be description of your application"><img src="<?= $pathurl?>/img/app_info_icon.png" ></a></span></label>
                <div class="controls">
                    <?php echo $form->textArea($model, 'description', array('class' => 'span5', 'rows' => 5, 'placeholder' => 'Enter a Description of Your App', 'id' => 'appDescription')); ?>
                    <?php echo $form->error($model, 'description',array('class'=>'alert alert-error')); ?>
                </div>
            </div>

            <div class="control-group">
<!--                 <label class="control-label ctrl_style">App Icon</label> -->
                <label class="control-label ctrl_style" style="width:100%;float:left;"><span style="float:left;margin-right:10px;">App Icon</span><span style="float:left;"><a href="#" class="eeee" data-toggle="tooltip" data-placement="right" title="" data-original-title="Please upload a 114x114 PNG image to avoid distortion.
                        Note: Apple does not allow transparency in iPhone app icons" ><img src="<?= $pathurl?>/img/app_info_icon.png" ></a></span></label>
                <div class="controls">
                     <!---->
                    
                         <?php echo $this->renderPartial('//appsetting/_app_icon',array('module_id'=>$model->id,'app_icon_img'=>$model->icon,'app_icon_new'=>1));?>
                    <!---->
                    <?php echo $form->hiddenField($model, 'icon'); ?>
                    <?php //echo $form->fileField($model, 'icon', array('class' => 'input-file', 'id' => 'uploadedFile')); ?>
                    <br/><br/>
                    <?php echo $form->error($model, 'icon',array('class'=>'alert alert-error')); ?>
<!--                     <p class="help-block">Please upload a 114x114 PNG image to avoid distortion.<br> -->
<!--                         Please note that Apple <strong>does not</strong> allow transparency in iPhone app icons</p> -->
                </div>
            </div>

            <div class="control-group">               
                <div class="controls">
                    <?php $_GET['app'] = 'localBusiness';
                    if (!isset($model->app_type)) {
                        switch ($_GET['app']) {
                            case 'localBusiness':
                                $app_type = 1;
                                break;
                            case 'niche':
                                $app_type = 2;
                                break;
                            case 'amazon':
                                $app_type = 3;
                                break;
                        }
                    } else {
                        $app_type = $model->app_type;
                    }
                    echo $form->hiddenField($model,'app_type',array('value'=>$app_type));
                    ?>
                </div>
            </div>

            <!-- 
            <div class="form-actions">
                <?php echo CHtml::submitButton('Update', array('class' => 'btn btn-success btn-large')); ?>
            </div>
			 -->
        </fieldset>
        <?php $this->endWidget(); ?>
        <script type="text/javascript">
	jQuery(document).ready(function(){
    $('.eeee').tooltip('hide')
	});
    
    
    
    function submitForm()
	{
		$('#user-form').submit();
	}
</script>
        
        <!-- Stick to top script -->
 <script type="text/javascript">
   // var flagloader = false;
$(document).ready(function() {
	var s = $(".fixed_top");
	var pos = s.position();					   
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		if (windowpos >= pos.top) {
			s.addClass("stick");
		} else {
			s.removeClass("stick");	
		}
	});
});
</script>
<style type="text/css">
.stick {
	position:fixed;
	top:0px;
	z-index:1000000;
	
}
</style>
 
 <!-- Stick to top script ends here -->
<!--     </div> -->
<!-- </div> -->
