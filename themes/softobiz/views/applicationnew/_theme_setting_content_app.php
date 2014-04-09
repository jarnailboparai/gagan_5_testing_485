<!-- Theme setting starts here -->

<div class="theme_content" style="display:none;"> 
  
  <!-- Image or color picker -->
  <div class="single_multi_icons theme_setting_thumb_app"> <a class="single staticPageForm" href="javascript:void(0)" onclick="set_image_app()"><img alt="single page" src="<?php echo Yii::app()->theme->baseUrl;?>/images/img_icon.png"><br>
    Image</a> <a class="multiple staticPageForm" href="javascript:void(0)" onclick="set_color_app()"><img alt="multiple page" src="<?php echo Yii::app()->theme->baseUrl;?>/images/color_picker.png"><br>
    Color Picker</a> </div>

</div>
<!-- Theme setting ends here -->
<div class="Bg_display_app"></div>


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
	


	function set_image_app()
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
			obj.flag = flag;
		    $.ajax({
		        type: 'POST',
		        url: baseurl+'/index.php?r=tutorial/image_background',
			    data: obj,
		        success: function(response){
		        	$('.theme_setting_thumb_app').hide();
		        	$('.Bg_display_app').html(response);
		        },
		        error: function(){
		            alert('error');
		        }
		    });
	}
	

	function set_color_app()
	{
		var flag = <?php echo $flag;?>;
		  $.ajax({
		        type: 'POST',
		        url: baseurl+'/index.php?r=tutorial/image_backgroundcolor',
		        data: {id:<?php echo $model->id;?>,flag:<?php echo $flag;?>},
		        success: function(response){
		        	$('.theme_setting_thumb_app').hide();
		        	$('.Bg_display_app').html(response);
		        },
		        error: function(){
		            alert('error');
		        }
		    });
	}
	
	function theme_setting_thumb_app()
	{	
		$('.Bg_display').html('');
		$('.Bg_display_app').html('');
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
