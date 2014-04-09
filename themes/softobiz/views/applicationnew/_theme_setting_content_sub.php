<!-- Theme setting starts here -->

<div class="theme_content_<?php echo $model->id; ?>" style="display:none;"> 
  
  <!-- Image or color picker -->
  <div class="single_multi_icons theme_setting_thumb_sub_<?php echo $model->id;?>"> <a class="single staticPageForm" href="javascript:void(0)" onclick="set_image_sub(<?php echo $model->id;?>,<?php echo $flag;?>)"><img alt="single page" src="<?php echo Yii::app()->theme->baseUrl;?>/images/img_icon.png"><br>
    Image</a> <a class="multiple staticPageForm" href="javascript:void(0)" onclick="set_color_sub(<?php echo $model->id;?>,<?php echo $flag;?>)"><img alt="multiple page" src="<?php echo Yii::app()->theme->baseUrl;?>/images/color_picker.png"><br>
    Color Picker</a> </div>

</div>
<!-- Theme setting ends here -->
<div class="Bg_display_sub_<?php echo $model->id;?>"></div>


 	<?php //echo $this->renderPartial('/applicationnew/_modaluploadBg' ,array("data"=>$model)); ?>
   <?php  //echo $this->renderPartial('/applicationnew/_modalimagenameuploadBg',array('module_id'=>$model->id,'layout'=>1));?>

  <script>
  /*
function openCloseMediaImageBg()
{	
	jQuery('#myModalMediaImageBg').modal('hide');
	jQuery('.modal-backdrop').remove();
	jQuery('#myModalMediaImageNameBg').removeData("modal");
	jQuery('#myModalMediaImageNameBg').modal({remote: "<?php echo CHtml::normalizeUrl(array('tutorial/uploadimage_background','layout'=>1))?>"});
		
}
*/
$('#myModalMediaImageBg').on('show.bs.modal', function (e) {
	$('.model_error').html("");
	})

$('#myModalMediaImageBg').on('hide.bs.modal', function (e) {
	jQuery('#myModalMediaImageBg').removeData("modal");
	})
	

/*
	function set_image_sub()
	{	
			var flag = <?php echo $flag;?>;
			var obj = {};
			   if(flag==1)
		       { 
				   obj.app_id = <?php echo $model->id;?>;
		       }
		       else if(flag==2)
		       {
		    	   obj.id = <?php echo $model->id;?>;
		       }
		       else if(flag==3)
		       {
		    	   obj.sub_module_id = <?php echo $model->id;?>;
		       }  
			
		    $.ajax({
		        type: 'POST',
		        url: baseurl+'/index.php?r=tutorial/image_background',
			    data: obj,
		        success: function(response){
		        	$(".theme_setting_thumb_sub_<?php echo $model->id;?>").hide();
		        	$('.Bg_display_sub_'+<?php echo $model->id; ?>).html(response);
		        },
		        error: function(){
		            alert('error');
		        }
		    });
	}
	

	function set_color_sub()
	{
	      
		  $.ajax({
		        type: 'POST',
		        url: baseurl+'/index.php?r=tutorial/image_backgroundcolor',
		        data: {id:<?php echo $model->id;?>,flag:<?php echo $flag;?>},
		        success: function(response){
		        	$(".theme_setting_thumb_sub_<?php echo $model->id;?>").hide();
		        	$('.Bg_display_sub_'+<?php echo $model->id; ?>).html(response);
		        },
		        error: function(){
		            alert('error');
		        }
		    });
	}
*/	
	function theme_setting_thumb_app()
	{	
		$('.theme_setting_thumb_app').show();
		$('.theme_image_background').hide();
		$('.color_picker_wrapper').hide();
		
	}

	  function save_bgcolor()
      {
         var color = $('.gradx_code').html();
         var id = <?php echo $model->id;?>;

         var flag = <?php echo $flag;?>;
			var obj = {};
			   if(flag==1)
		       { 
				   obj.app_id = <?php echo $model->id;?>;
		       }
		       else if(flag==2)
		       {
		    	   obj.id = <?php echo $model->id;?>;
		       }
		       else if(flag==3)
		       {
		    	   obj.sub_module_id = <?php echo $model->id;?>;
		       }  
			   obj.color = color;

    		
         $.ajax({
		        type: 'POST',
		        url: baseurl+'/index.php?r=tutorial/app_bgcolor',
		        data: obj,
		        success: function(response){
		        	//$('.theme_setting_thumb_app').hide();
		        	//$('.Bg_display').html(response);
		        },
		        error: function(){
		            alert('error');
		        }
		    });

       	
      }

</script>
