<div class="theme_title theme_setting_title">
	<div class="container">
    <div class="btn-group pull-left navbottom">
          <button class="btn app_info selected_app selected" onclick="setting_show_app()"><span style="background: none !important;padding-left:0px;">Features List</span></button>
          <button class="btn app_setting_app" onclick="setting_hide_app_bg()"><span>Main Theme Settings</span></button>
          <!--<button class="btn content"><span>Select Content</span></button>-->
        </div>
  </div>
</div>



<script>
	function setting_show_app()
	{	
		$('.app_setting_app').removeClass('selected');
		$('.app_info').addClass('selected');
		$('.sub_list_wrapper').show();
		$('.theme_content').hide();
		$('.Bg_display_app').html('');
		
/*		
		$('.Bg_display').html('');
		$('.theme_image_background').hide();
		$('.color_picker_wrapper').hide();
		
		$('.form-horizontal').show();
		$('.theme_content').hide();
		*/
	}

	function setting_hide_app()
	{
		$('.app_setting_app').addClass('selected');
		$('.app_info').removeClass('selected');
		
		$('.sub_list_wrapper').hide();
		$('.theme_content').show();
		$('.theme_setting_thumb_app').show();
		$('.Bg_display_app').html('');
		
/*
		$('.form-horizontal').hide();
		$('.theme_content').show();
		$('.theme_setting_thumb').show();
		$('.Bg_display').html('');

		*/
	}

	function setting_hide_app_bg()
	{
		default_setting_app();
		
	}
	
	function default_setting_app()
	{
		var flag = <?php echo $flag;?>;
		  $.ajax({
		        type: 'POST',
		        url: baseurl+'/index.php?r=tutorial/check_appbg',
		        data: {app_id:<?php echo $model->id;?>,flag:<?php echo $flag;?>},
		        success: function(response){
		        	$('.app_setting_app').addClass('selected');
		    		$('.app_info').removeClass('selected');
		    		$('.sub_list_wrapper').hide();
		    		$('.Bg_display_app').html('');

		        	if(response==1)
		        	{
		        		set_image_app();
		        	}
		        	else if (response==2)
		        	{
		        		set_color_app();
		        	}
		        	else
		        	{
		        		$('.app_setting_app').addClass('selected');
		        		$('.app_info').removeClass('selected');
		        		
		        		$('.sub_list_wrapper').hide();
		        		$('.theme_content').show();
		        		$('.theme_setting_thumb_app').show();
		        		$('.Bg_display_app').html('');
		        	}
		        },
		        error: function(){
		            alert('error');
		        }
		    });

	}
	

</script>
