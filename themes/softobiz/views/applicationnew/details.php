<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/validate_detail.js"></script>
<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<link href="<?php echo $pathurl; ?>/css/icons.css" rel="stylesheet" type="text/css"></link>
<?php
//$pathurl = Yii::app()->theme->baseUrl;
// if (isset($disabled))
//     $this->renderPartial("app_menu", array('style' => $style, 'disabled' => $disabled));
// else
//     $this->renderPartial("app_menu", array('style' => $style));
?>

<?php echo $this->renderPartial('_navbottom',array('data'=>array('formId'=>'user-form','tabselect'=>'select_info'))); ?>	
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
            'htmlOptions' => array('enctype' => 'multipart/form-data','name'=>'user-form','class'=>'form-signin',"onsubmit"=>"user_valid()"),
                ));
        ?>
         <h4 class="form-signin-heading">
    	App Details  Check deploy<br/>
    </h4>
        <fieldset>
            <div class="control-group">
                <label class="control-label ctrl_style" style="width:100%;float:left;"><span style="float:left;margin-right:10px;">App Title</span><span style="float:left;"><a href="#" class="eeee" data-toggle="tooltip" data-placement="right" title="" data-original-title="This will the title of application.Note: App Title space and special characters(@#$%^) not allowed."><img src="<?= $pathurl?>/img/app_info_icon.png" ></a></span></label>
                <div class="controls">
                    <?php echo $form->textField($model, 'title', array('placeholder' => 'Enter Your App name', 'id' => 'appTitle', 'class' => 'span5')); ?>
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
                    <?php echo $form->textField($model, 'id_app', array('placeholder' => 'Enter Your App id', 'id' => 'appId', 'class' => 'span5','disabled'=>$arr )); ?>
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
                    <?php /*?><a data-target="#myModalMediaImage" href="<?php echo CHtml::normalizeUrl(array('mediafiles/index','module_id'=>$model->id,'layout'=>1))?>" role="button" class="btn btn-primary big_btn" data-toggle="modal" >Add Icon</a><?php */?>
                    
                    <?php //echo $this->render('//mediafiles/index_appicon',array('module_id'=>$model->id));?>
                    
                    <!---->
                    
                         <?php echo $this->renderPartial('//applicationnew/_app_icon',array('module_id'=>$model->id,'app_icon_new'=>1));?>
                    <!---->
                   
                    <?php echo $form->hiddenField($model, 'icon',array('value'=>'')); ?>
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


            <div class="form-actions continue_button">
                <?php echo CHtml::submitButton('Save & Continue', array('class' => 'btn btn-primary btn-large')); ?>
            </div>

        </fieldset>
        <?php $this->endWidget(); ?>
        <script type="text/javascript">
	jQuery(document).ready(function(){
    $('.eeee').tooltip('hide')
	});
    </script>
        
<!--     </div> -->
<!-- </div> -->
