
<div class="form">

<?php //$form=$this->beginWidget('CActiveForm');  //$form->s ?>
<?php $form=$this->beginWidget('CActiveForm',array('id'=>'themeForm','htmlOptions'=>array('name'=>'themeForm'))); ?>

	<?php /*  <p class="note">Fields with <span class="required">*</span> are required.</p> */ ?>

	<?php //echo CHtml::errorSummary($model); ?>

	<div class="row" style="display:none;">
		<?php //echo $form->labelEx($model,'feature'); ?>
		<?php echo $form->checkBoxList($model,'name',$data); ?>
		<?php //echo $form->error($model,'feature'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
<script>
/*
function submitForm()
{
	var form = document.forms.themeForm;

	$(form).submit();
	//console.log("asd");
}
*/
function submitForm()
{
   var form = document.forms.themeForm;
   var count_features = $( "input:checked" ).length;
	if(count_features>0)
	{
		$(form).submit();
	}
   else
	{
		$('.select_feature_error').html("<div class='alert alert-danger'><strong>Select Atleast One Feature</strong></div>");
	}
}

</script>





</div><!-- form -->
