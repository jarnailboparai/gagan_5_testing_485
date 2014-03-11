
<?php
$this->renderPartial("app_menu", array('style' => $style));
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<div class="body_right" style="width:350px; float:left; padding-left:30px; font-size:24px;">Select Operating System:<br />
   <!-- <br />

    <label style="width: 136px;">
        <?php//echo $form->checkBox($model, 'iphone'); ?>
        <img src="<?//= Yii::app()->theme->baseUrl; ?>/images/apple.jpg" id="ytApplication_android" width="205" height="42" style="margin-left: 19px;margin-top: -41px;float: left;cursor: pointer;width: 120px;" />
    </label>
    <br />
    <label style="width: 223px;">
        <?php// echo $form->checkBox($model, 'android'); ?>
        <img src="<?//= Yii::app()->theme->baseUrl; ?>/images/android.jpg" width="205" height="42" style="margin-left: 22px;margin-top: -43px;float: left;cursor: pointer;" />
    </label>-->
    <br />
    <?php echo CHtml::submitButton('Build Your App', array('application/buildapp', "class" => "buildButton")); ?> <br />
</div>

<?php $this->endWidget(); ?>
