<div class="form" id="form_features_div">

<?php $form=$this->beginWidget('CActiveForm',array(
		'id' => 'form-features',
		'action'=> 'index.php?r=applicationnew/addSelectFeatures',
		'htmlOptions'=>array(
				'onsubmit' => 'return checkSelectForm();',   /* Disable normal form submit */
				//'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
			)
		 
		));  //$form->s ?>

	<?php /*  <p class="note">Fields with <span class="required">*</span> are required.</p> */ ?>

	<?php //echo CHtml::errorSummary($model); ?>
	<input type='text' name='content_count' id='count_content' value='' />
	<div class="row" style="display:none;">
		<?php //echo $form->labelEx($model,'feature'); ?>
		<?php echo $form->checkBoxList($model,'name',$data); ?>
		<?php //echo $form->error($model,'feature'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
function checkSelectForm()
{
	
	//return false;
}

$(document).ready(function(){
	$("#form-features input[type=checkbox]").click(function(){ 
		//alert($(this).is(':checked'));
		//if( )
		if( $(this).val() == 'content' ){
			if($(this).is(':checked')){

				$('#count_content').show();

			}else{

				$('#count_content').hide();
			}
		}

	});
		
});
</script>
