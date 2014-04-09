<div class="theme_title theme_setting_title">
	<div class="container">
    <div class="btn-group pull-left navbottom">
          <button class="btn app_info_module selected" onclick="setting_show(<?php echo $flag;?>)"><span style="background: none !important;padding-left:0px;">Edit Content</span></button>
          <button class="btn app_setting_module" onclick="setting_hide_module(<?php echo $flag;?>)"><span>Theme Settings</span></button>
          <!--<button class="btn content"><span>Select Content</span></button>-->
        </div>
  </div>
</div>



<script>
	function setting_show()
	{	
		//$('#wrapperliUl li #formId').remove();
		$('.Bg_display').html('');
		$('.theme_image_background').hide();
		$('.color_picker_wrapper').hide();
		$('.app_setting_module').removeClass('selected');
		$('.app_info_module').addClass('selected');
		$('.form-horizontal').show();
		$('.sub_page_wrapper').show();
		$('.theme_content').hide();
	}

	function setting_hide()
	{
		//$('#wrapperliUl li #formId').remove();
		$('.theme_setting_thumb_app').hide();
		$('.app_setting_module').addClass('selected');
		$('.app_info_module').addClass('selected');
		$('.app_info_module').removeClass('selected');
		$('.form-horizontal').hide();
		$('.sub_page_wrapper').hide();
		$('.theme_content').show();
		$('.theme_setting_thumb').show();
		$('.Bg_display').html('');
	}

	function setting_hide_module()
	{
		default_setting_module();
	}
	

	function default_setting_module()
	{
		var flag = <?php echo $flag;?>;
		  $.ajax({
		        type: 'POST',
		        url: baseurl+'/index.php?r=tutorial/check_appbg',
		        data: {id:<?php echo $model->id;?>,flag:<?php echo $flag;?>},
		        success: function(response){
		        	$('.theme_setting_thumb_app').hide();
	        		$('.app_setting_module').addClass('selected');
	        		$('.app_info_module').addClass('selected');
	        		$('.app_info_module').removeClass('selected');
	        		$('.form-horizontal').hide();
	        		$('.sub_page_wrapper').hide();
	        		$('.Bg_display').html('');
		        	
		        	if(response==1)
		        	{
		        		set_image();
		        	}
		        	else if (response==2)
		        	{
		        		set_color();
		        	}
		        	else
		        	{
		        		$('.theme_setting_thumb_app').hide();
		        		$('.app_setting_module').addClass('selected');
		        		$('.app_info_module').addClass('selected');
		        		$('.app_info_module').removeClass('selected');
		        		$('.form-horizontal').hide();
		        		$('.sub_page_wrapper').hide();
		        		$('.theme_content').show();
		        		$('.theme_setting_thumb').show();
		        		$('.Bg_display').html('');
		        	}
		        },
		        error: function(){
		            alert('error');
		        }
		    });

	}


	
</script>
