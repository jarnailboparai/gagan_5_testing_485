<style>
.video_desc_panel { display:block !important;}

</style>
<!-- Video Description Form -->

<script>

jQuery(document).ready(function(){
	
	jQuery('#video-files-form').on('submit',function(e){
		e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('video-files-form');
	   // alert(postData);
	   // alert(actionUrl);
		
	    $.ajax({
	        type: 'POST',
	        url: actionUrl.action,
	        data: postData,
	        success: function(response){
				//alert('eee');
				//var arg = JSON.parse(response);
	        	//popdetialHideOther(arg);
	        	
	        	jQuery( "#imageListUpdateVideo").html(response);
				jQuery( ".row-fluid.manage_apps.media_gallery.tab_gallery.video_gallery").show();
				//jQuery('#myModalVideoCustom').modal('hide');
				 //jQuery('#myModalVideo').removeData("modal");
	        	 //jQuery('#myModalVideo').modal({remote: '<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$module_id,'layout'=>1))?>'});
	        	
				return false;
			
	        	console.log("done");
	        	console.log(response);
	        	 jQuery('#myModalVideo').removeData("modal");
	        	 jQuery('#myModalVideo').modal({remote: '<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$module_id,'layout'=>1))?>'});
	        	 //jQuery('#myModalThumb').removeData("modal");
	        	 //jQuery('#myModalVideoCustom').removeData("modal");
	        	 jQuery('#myModalVideoCustom').modal('toggle');
	        	 jQuery('#myModalVideoCustom').removeData("modal");
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});
	
});


function thumbModalNew(arg){
		//jQuery('#file_upload').uploadifive('destroy');
		console.log('thumbalink',jQuery(arg).attr('link'));
		jQuery('#myModalThumb').removeData("modal");
   	 	jQuery('#myModalThumb').modal({remote: jQuery(arg).attr('link')});
   	 	jQuery('#myModalThumb').modal('show');
   	 	return false;
		
	}

function submitformVideo(arg)
{
		console.log(arg);
	    var postData = $(arg).serialize();
	   // var actionUrl = document.getElementById('video-files-form');
	   // alert(postData);
	   // alert(actionUrl);
		
	    $.ajax({
	        type: 'POST',
	        url: arg.action,
	        data: postData,
	        success: function(response){
				//alert('eee');
				//var arg = JSON.parse(response);
	        	//popdetialHideOther(arg);
	       		jQuery( "#imageListUpdateVideo").html(response);
				jQuery( ".row-fluid.manage_apps.media_gallery.tab_gallery.video_gallery").show();
				jQuery('#myModalVideoCustom').modal('hide');
				 jQuery('#myModalVideo').removeData("modal");
	        	 jQuery('#myModalVideo').modal({remote: '<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$module_id,'layout'=>1))?>',show:false});
				
				return false;
				
	        	console.log("done");
	        	console.log(response);
	        	jQuery('#myModalVideo').removeData("modal");

				jQuery('.modal-backdrop').remove();
	        	 
	        	jQuery('#myModalVideo').modal({remote: '<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$module_id,'layout'=>1))?>'});
	        	 //jQuery('#myModalThumb').removeData("modal");
	        	 //jQuery('#myModalVideoCustom').removeData("modal");
	        	 jQuery('#myModalVideoCustom').modal('toggle');
	        	 jQuery('#myModalVideoCustom').removeData('modal');
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	return false;

}




</script>
<div class="video_desc_panel">

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'video-files-formaqsw',
			'enableAjaxValidation'=>false,
				'htmlOptions' => array(
						'class' => 'form-horizontal',
						'enctype' => 'multipart/form-data',
						'onsubmit' => 'return submitformVideo(this)'
				),
)); ?>
		<div class="row-fluid">
<div class="limited_modal">
			<div class="span8">
			<?php echo $form->errorSummary($model); ?>
				<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'placeholder'=>"Title")); ?>
				<?php echo $form->textArea($model,'description',array('rows'=>3,'placeholder'=>"Short description")); ?>

				<div class="input-prepend">
					<span class="add-on">Add Video Links</span> 
						<?php echo $form->textField($model,'actual_url',array('class'=>"span10"	,'id'=>"prependedInput", 'placeholder'=>"link",'maxlength'=>255)); ?>
				</div>

				<p class="note">
					Video Links<br> <span>Please provide links to all the formats for
						the video, as each of them is required by each format. </span>
				</p>

				<?php echo $form->textField($model,'mp4_url',array('size'=>60,'maxlength'=>255,'placeholder'=>"Link to MP4 File")); ?>
				<?php echo $form->textField($model,'threegp_url',array('size'=>60,'maxlength'=>255,'placeholder'=>"Link to 3GP File")); ?>
				<?php echo $form->textField($model,'m4v',array('size'=>60,'maxlength'=>255,'placeholder'=>"Link to MP4 File")); ?>
			</div>
			<div class="span4">
				<div class="thumb_panel">
					<div class="thumb" id="thumbImage">
						<?php if(!isset($model->thumbnail_url)){ ?>
						<?php echo CHtml::image('images/no_thumb.jpg','no thumb',array())?>
						<?php }else{
							//print_r($model->filemediaImage);
							//echo CHtml::image('images/thumb.jpg','no thumb',array());
							 $r = pathinfo($model->filemediaImage->filename);   echo CHtml::image(Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/'.$r['filename'].'_256x256.jpg'); 
						}?>
					</div>
					<div class="thumb_btn">
<!-- 					<a data-target="#myModalThumb" href="<?php echo CHtml::normalizeUrl(array('mediafiles/imagelistthumb','layout'=>1,'selected'=>$model->thumbnail_url))?>" role="button" class="btn" data-toggle="modal" >Change</a> -->
					 		<a href="javascript:void(0);" link="<?php echo CHtml::normalizeUrl(array('mediafiles/imagelistthumb','layout'=>1,'select'=>$model->thumbnail_url))?>"  class="btn btn-info thumbalink" onclick="thumbModalNew(this)" >Change or Choose </a>
						<?php //echo CHtml::hiddenField("VideoFiles[thumbnail_url]"); ?>
						<?php echo $form->hiddenField($model,'thumbnail_url'); ?>
<!-- 						<input name="" class="btn btn-danger" type="button" value="Remove"> -->
					</div>
				</div>
			</div>

		</div>
		</div>
		<div class="button_pan">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Save Changes' : 'Save',array('class'=>"btn btn-success",'onclick'=>'javascript:void(0)')); ?>
			<input type="button" value="Cancel" class="btn" onclick="openCloseCustomOpenVideo()">
			
		</div>
		<?php echo CHtml::hiddenField("module_id",$module_id); ?>
		<?php $this->endWidget(); ?>
		<?php echo $this->renderPartial('_modalupload' ,array("data"=>$model)); ?>

</div>
