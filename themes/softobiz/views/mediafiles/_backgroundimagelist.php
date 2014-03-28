<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>

<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $pathurl; ?>/js/jqueryeditable/jquery-editable/css/jquery-editable.css" />
	<script type="text/javascript" src="<?php echo $pathurl; ?>/js/jqueryeditable/jquery-editable/js/jquery.poshytip.js"></script>
	<script type="text/javascript" src="<?php echo $pathurl; ?>/js/jqueryeditable/jquery-editable/js/jquery-editable-poshytip.js"></script>

<div class="row-fluid manage_apps media_gallery edit_title">
<!-- <form method="post" name="selectedImages" id="selectedImages" > -->
<?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'selected-images',
        	'action'=> CHtml::normalizeUrl(array('tutorial/uploadbackground')),
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data',
            	'onsubmit' => 'return false;'
				
            ),
        )); ?>
	<ul id="medialistImageUpload">
		<?php echo $this->renderPartial('/mediafiles/_medialist',array('dataProvider'=>$dataProvider,'selected'=>$selected));?>
	</ul>
	<div><?php $app_id=2;?>
		<?php  echo CHtml::hiddenField('app_id',$app_id); ?>
	</div>
<div id="done" style="width:100%;float:left; display:none; ">
	<input class="done" id="donephotoindex" style="width:100px;float:left; padding:5px; margin:5px;"  type="submit" name="done" value="Done" >
</div>
        <?php $this->endWidget(); ?>
<!-- </form> -->
	
	
</div>
<div>
<!-- 	<div id="queueOpen" class="align-center"></div>  -->
	<?php //echo $this->renderPartial('_uploadfile'); ?>
</div>



<script>

	function liUpdateSelectImageMedia(arg)
	{

		if($(arg).hasClass('enabled'))
		{	
			$(arg).removeClass('enabled');
			$(arg).find('#checkmedia').prop('checked', false);
		
		}else{
			jQuery('#medialistImageUpload li').removeClass('enabled');
			jQuery('#medialistImageUpload li input[type="checkbox"]').prop('checked', false)
			$(arg).addClass('enabled');
			$(arg).find('#checkmedia').prop('checked', true)
			
		}
	}
	
jQuery(document).ready(function(){
	
	jQuery('#selected-images').submit(function(e){
		e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('selected-images');
	   // console.log(postData);
	   // console.log(actionUrl);
		
	    $.ajax({
	        type: 'POST',
	        url: actionUrl.action,
	        data: postData,
	        success: function(response){
				//alert('eee');
				var arg = response.trim();
				jQuery('.modal-backdrop').remove();
				
				if(arg == 'stop'){
					jQuery('.photowrapper').removeClass('show');
					jQuery("#myModalMediaImage").modal('hide');
					jQuery('#myModalMediaImage').removeData("modal");
					//jQuery('.modal-backdrop').remove();
				}else{
					//jQuery('#myModalMediaImage').modal('hide');
					
					
					jQuery('#myModalMediaImageName').removeData("modal");
					
					jQuery( "#imageListUpdatePhoto").html(response);
					jQuery("#myModalMediaImage").modal('hide');

					jQuery('.photowrapper').addClass('show');
				}


				//jQuery( ".close" ).trigger( "click" );
				//myUpdate();
				// $('#Demo').perfectScrollbar('update');
	        	//popdetialHideOther(arg);
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});

	jQuery('#formIdSubmitPhoto').click(function(){
		
		jQuery( "#donephotoindex" ).trigger( "click" );

		//jQuery('#selected-images').submit();
		
	});

	jQuery('.mediafile_original_name').editable({
		mode:'inline',
	
		url:function(value){
			var id=$(this).attr('id').split('_');
			var data = {};
			console.log($(this));
			data["MediaFiles[id]"] = id[1];
			data["MediaFiles[name]"] = value.value;
			jQuery.post(baseurl+'/index.php?r=mediafiles/nameedit',data,function(response){
				//return response.Number.forward_number;
			});
		},
	});
			
	
});



</script>
