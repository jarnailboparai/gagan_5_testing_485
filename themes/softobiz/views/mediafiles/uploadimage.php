<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>

<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css" />
<?php /* ?>
<link href="<?php echo $pathurl; ?>/js/editable/editable.css" rel="stylesheet"/>
<script src="<?php echo $pathurl; ?>/js/editable/editable.min.js"></script> <?php 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.js"></script> */ ?>

	<link rel="stylesheet" type="text/css" href="<?php echo $pathurl; ?>/js/jqueryeditable/jquery-editable/css/jquery-editable.css" />
	<script type="text/javascript" src="<?php echo $pathurl; ?>/js/jqueryeditable/jquery-editable/js/jquery.poshytip.js"></script>
	<script type="text/javascript" src="<?php echo $pathurl; ?>/js/jqueryeditable/jquery-editable/js/jquery-editable-poshytip.js"></script>

<div class="row-fluid manage_apps media_gallery">
<!-- <form method="post" name="selectedImages" id="selectedImages" > -->
<?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'selected-images',
        	'action'=> CHtml::normalizeUrl(array('mediafiles/selectimages')),
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data',
            	'onsubmit' => 'return false;'
            ),
        )); ?>
	<ul id="medialistImageUpload">
		<?php echo $this->renderPartial('_medialist',array('dataProvider'=>$dataProvider,'selected'=>$selected));?>
	</ul>
	<div>
		<?php  echo CHtml::hiddenField('module_id',$module_id); ?>
	</div>
<div id="done" style="width:100%;float:left; display:none; ">
	<input class="done" id="donephotoindex" style="width:100px;float:left; padding:5px; margin:5px;"  type="submit" name="done" value="Done" >
</div>
        <?php $this->endWidget(); ?>
<!-- </form> -->
	
	
</div>
<div>
	<div id="queueOpen" class="align-center"></div> 
	<?php //echo $this->renderPartial('_uploadfile'); ?>
</div>

<script>
/*	$(document).ready(function(){
		$('#medialistImageUpload li').on('click',function(){
			

			if($(this).hasClass('enabled'))
			{	
				$(this).removeClass('enabled');
				$(this).find('#checkmedia').attr("checked",false);
				console.log($(this).attr('id'));
			}else{
				$(this).addClass('enabled');
				$(this).find('#checkmedia').attr("checked",true);	
				console.log($(this).attr('id'));
			}
		});

	});
*/
	function liUpdateSelectImageMedia(arg)
	{

		if($(arg).hasClass('enabled'))
		{	
			$(arg).removeClass('enabled');
			$(arg).find('#checkmedia').attr("checked",false);
			console.log($(arg).attr('id'));
		}else{
			$(arg).addClass('enabled');
			$(arg).find('#checkmedia').attr("checked",true);	
			console.log($(arg).attr('id'));
		}

			
	}
	
</script>
<script>
jQuery(document).ready(function(){
	
	jQuery('#selected-images').submit(function(e){
		e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('selected-images');
	   // alert(postData);
	   // alert(actionUrl);
		
	    $.ajax({
	        type: 'POST',
	        url: actionUrl.action,
	        data: postData,
	        success: function(response){
				//alert('eee');
				var arg = response.trim();
			
				if(arg == 'stop'){
					jQuery('.photowrapper').removeClass('show');
					jQuery("#myModalMediaImage").modal('toggle');
				}else{
					jQuery( "#imageListUpdatePhoto").html(response);
					jQuery("#myModalMediaImage").modal('toggle');
					if(!jQuery('.photowrapper').hasClass('show'))
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
		
	});

	jQuery('.mediafile_original_name').editable({
		mode:'inline',
		/*validate: function(value) {
			var num_reg = /^\d{1,5}(\.\d{1,2})?$/;
			if(!num_reg.test(value)) {
			return 'Please Enter valid amount';
			}
		},*/
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

<?php $this->renderPartial('//mediafiles/_uploadfile');?>
