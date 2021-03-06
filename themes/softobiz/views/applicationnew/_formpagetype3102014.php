<!-- Two main icons starts here -->
<div class="single_multi_icons"> 
	<a href="javascript:void(0)" class="single staticPageForm_<?php echo $module_id; ?>"><img src="images/single_page.png" alt="single page"><br>Single</a>
	<a href="javascript:void(0)" class="multiple staticPageForm_<?php echo $module_id; ?>"><img src="images/multiple_page.png" alt="multiple page"><br>Multiple</a> 
</div>

<!-- Two main icons ends here -->

<div class="form" style="display:none">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'module-formsPage_'.$model->id,
	'action'=> CHtml::normalizeUrl(array('applicationnew/selectPage')),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'id'); ?>
	</div>
	<div class="row">
		<?php $data = array('0'=>'select','1'=>'Single Page','2'=>'Multiple page'); echo $form->labelEx($model,'page_type'); ?>
		<?php echo $form->dropDownList($model,'page_type',$data,array()); ?>
		
		<?php echo $form->error($model,'page_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('id'=>'staticPageFormButtonSubmit_'.$model->id)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
jQuery(document).ready(function(){
	jQuery('.staticPageForm_<?php echo $module_id; ?>').on('click',function(){
		console.log(this);

		if(jQuery(this).hasClass('single'))
			$('#Module_page_type').val(1);

		if(jQuery(this).hasClass('multiple'))
			$('#Module_page_type').val(2);

		/*staticPageFormButton_215 */
		jQuery( "#staticPageFormButton_<?php echo $module_id; ?>" ).attr('onclick','popupdetial(this)');
		jQuery( "#staticPageFormButtonSubmit_<?php echo $module_id; ?>" ).trigger( "click" );
		
	});

	jQuery('#module-formsPage_<?php echo $module_id; ?>').submit(function(e){
		e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('module-formsPage_<?php echo $module_id; ?>');
	   // alert(postData);
	   // alert(actionUrl);
		
	    $.ajax({
	        type: 'POST',
	        url: actionUrl.action,
	        data: postData,
	        success: function(response){
	        	//popupdetial();
				//console.log('eee');
				//var arg = JSON.parse(response);
				//jQuery( "#imageListUpdate").html(response);
				//jQuery( ".close" ).trigger( "click" );
				//jQuery( ".close" ).trigger( "click" );
				//myUpdate();
				// $('#Demo').perfectScrollbar('update');
	        	//popdetialHideOther(arg);
			
				jQuery( "#staticPageFormButtonSubmit_<?php echo $module_id; ?>" ).trigger( "click" );
			
				//console.log('sdf');
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});
});
</script>
