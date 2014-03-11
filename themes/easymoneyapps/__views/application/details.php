<?php
if (isset($disabled))
    $this->renderPartial("app_menu", array('style' => $style, 'disabled' => $disabled));
else
    $this->renderPartial("app_menu", array('style' => $style));
?>


<?php if (Yii::app()->user->hasFlash('create_app_error')): ?>
    <div class="errorMessage"><?php echo Yii::app()->user->getFlash('create_app_error'); ?></div>
<?php endif; ?>

<div class="row">
    <h1 class="app_details_style">App Details <br/><span>The following details are used for your app submission.</span></h1>
    <div class="span7">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
        ?>
        <fieldset>
            <div class="control-group">
                <label class="control-label ctrl_style">App Title</label>
                <div class="controls">
                    <?php echo $form->textField($model, 'title', array('placeholder' => 'Enter Your App name', 'id' => 'appTitle', 'class' => 'span5')); ?>
                    <?php echo $form->error($model, 'title'); ?>
                    <span class="help-block">Please use Alphanumeric characters and Spaces only. Special characters such as &amp;, *,$, etc are are not possible in your App Title.</span>
                </div>
            </div>
     <div class="control-group">
                <label class="control-label ctrl_style">App Id</label>
                <div class="controls">
                    <?php echo $form->textField($model, 'id_app', array('placeholder' => 'Enter Your App id', 'id' => 'appTitle', 'class' => 'span5')); ?>
                    <?php echo $form->error($model, 'id_app'); ?>
                    <span class="help-block">Please use com.example.type .</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label ctrl_style">App Description</label>
                <div class="controls">
                    <?php echo $form->textArea($model, 'description', array('class' => 'span5', 'rows' => 5, 'placeholder' => 'Enter a Description of Your App', 'id' => 'appDescription')); ?>
                    <?php echo $form->error($model, 'description'); ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label ctrl_style">App Icon</label>
                <div class="controls">
                    <?php echo $form->fileField($model, 'icon', array('class' => 'input-file', 'id' => 'uploadedFile')); ?>
                    <?php echo $form->error($model, 'icon'); ?>
                    <p class="help-block">Please upload a 114x114 PNG image to avoid distortion.<br>
                        Please note that Apple <strong>does not</strong> allow transparency in iPhone app icons</p>
                </div>
            </div>

            <div class="control-group">
                <!--<label class="control-label ctrl_style">App type</label>-->
                <div class="controls">
                    <?php
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
//							$model->app_type = 1;
//						echo $form->radioButtonList($model,'app_type',
//								array(
//									'1'=>'Offline bussiness',
//									'2'=>'Website',
//									'3'=>'Both'
//								), 
//								array('labelOptions'=>array('style'=>'display:inline'))); 
                    ?>
                </div>
            </div>

            <!--			<div class="control-group">
                                            <label class="control-label ctrl_style">Platforms</label>
                                            <div class="controls">
                                                    <label class="checkbox">
            <?php echo $form->checkBox($model, 'iphone'); ?>
                                                              iPhone
                                                    </label>
            
                                                    <label class="checkbox">
            <?php echo $form->checkBox($model, 'android'); ?>
                                                              Android
                                                    </label>
                                            </div>
                                     </div>-->

            <!--			<div class="control-group">
                                            <label class="control-label ctrl_style">Notifications</label>
                                            <div class="controls">
                                                    <label class="checkbox">
            <?php echo $form->checkBox($model, 'notifications'); ?>
                                                              Enable
                                                    </label>
                                            </div>
                                     </div>-->

            <div class="form-actions continue_button">
                <?php echo CHtml::submitButton('Save & Continue', array('class' => 'btn btn-primary btn-large')); ?>
            </div>

        </fieldset>
        <?php $this->endWidget(); ?>
    </div>
</div>
