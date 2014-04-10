<!--  Single page tab design starts here -->
<link href="/members/wizard/themes/softobiz/css/media_gallery.css" rel="stylesheet" type="text/css"></link>

<div class="single_page">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
			'id' => 'module-form-module',
			//'action'=> 'index.php?r=applicationnew/customize_modules_details',
			'enableAjaxValidation' => false,
			'htmlOptions' => array(
					'class' => 'form-horizontal',
					'enctype' => 'multipart/form-data',
					'onsubmit' => 'return customizemodulenew();'
			),
	));

	//echo $model->name;
	//echo "<pre>";print_r($model); die;
	$title = '';
	$module_info = ModuleFile::model()->findByAttributes(array('name' => $model->name));
	if(count($module_info)){
		if ($model->tab_title == NULL)
			$title = $module_info->title;
		else
			$title = $model->tab_title;
	}
	if ($title == '')
		$title = $model->name;
	//echo "<pre>";print_r($module_info); die;
	$keyword_arr = array('news(keyword)', 'events(keyword)', 'twitter(keyword)', 'youtube(keyword)', 'photoGallery(keyword)');
	$username_arr = array('twitter', 'facebook', 'youtube');
	$rss_arr = array('rss_feeds');
	$photo_gallery_arr = array('photo_gallery',);
	//      $content_arr = array('about_us', 'location', 'opening_hours', 'testimonials', 'contact_us');
	$content_arr = array('about_us', 'opening_hours', 'testimonials', 'contact_us','staticpage');
	$web_page_arr = array('web_page');
	$photos_arr = array('photos');
	$content = array('content', 'content2', 'content3', 'content4');
	$notification = array('notification');
	$admob = array('Admob');
	$optin_form = array('optin_form');
	$location = array('location');
	?>
	<table class="title_table">
		<tr>
			<td>
<!-- 			<input type="text" placeholder="Title"> -->
				<?php echo $form->textField($model, 'tab_title', array( 'placeholder'=>"Title",'value' => $title)); ?>
			</td>
			<td>
			 <?php echo $form->hiddenField($model, 'tab_icon'); ?>
			<span class="icon_wrapper">
<!--                   <div title="Select Icon" class="select_icon"></div> -->
                  
                  <span class="select_icon change_icon_block_image_wrapper image">

                                <img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/icons_communication_1092.png" />

                  </span>
                  
                  <div class="change_icon_block_popup">

                                <em>X</em>

                                <ul class="change_icon_block_tabs">

                                    <li class="grey_icons active">Grey Icons</li>

                                    <!--<li class="black_icons">Black Icons</li>-->

                                    <li class="white_icons">White Icons</li>

                                </ul>

                                <ul class="change_icon_block_tabs_content">

                                    <li id="grey_icons" class="current_tab_content">

                                        <span><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/icons_communication_1092.png" /></span>

                                        <?php for ($i = 1; $i <= 400; $i++) { ?>

                                            <span><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/grey/icon(<?= $i; ?>).png" /></span>


                                        <?php } ?>

                                    </li>

                                    <li id="white_icons">

                                        <?php for ($i = 1; $i <= 400; $i++) { ?>

                                            <span><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/white/icon(<?= $i; ?>).png" /></span>

                                        <?php } ?>

                                    </li>

                                </ul>

                            </div>
                  
                  
                  
             </span>
			</td>
		</tr>
	</table>

	<div class="content_editor">
	<textarea id="editor1" name="Module[description]" style="width: 100%;height: 300px" cols="100"><?= $model->description ?></textarea>
				<script>
                    var nicedt;
                    //<![CDATA[
                  /*  bkLib.onDomLoaded(function() {
                        nicedt = new nicEditor({maxHeight: 300, fullPanel: true}).panelInstance('editor1');
                        nicedt.instanceById('editor1').setContent($('textarea[name="Module[description]"]').val());
                    }); */
                    //]]>
                    function myBk(){
                    	nicedt = new nicEditor({maxHeight: 300, fullPanel: true}).panelInstance('editor1');
                       // nicedt.instanceById('editor1').setContent($('textarea[name="Module[description]"]').val());
                    
               		}
                		myBk();
					
              </script>
	
	</div>
	<div class="button_panel">
		<?php echo CHtml::submitButton('Save', array('onclick'=>"nicEditors.findEditor('editor1').saveContent();",'class' => 'btn btn-success')); ?>
		<?php echo CHtml::button('Cancel', array('class' => 'btn cancel_singlepage','onclick'=>"feature_listing()")); ?>
		<?php //echo CHtml::link('Return to Tab List', array('/application/customizemodules'), array('class' => 'btn btn-large btn_radius btn-primary4')); ?>
		
	</div>
	<?php $this->endWidget(); ?>
</div>

<!-- Single page tab design ends here -->

<script>
jQuery(document).ready(function(){
	
	jQuery('#module-form-module').submit(function(e){
		
		 e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('module-form-module');
	   // alert(postData);
	   // alert(actionUrl);
	  
	    $.ajax({
	        type: 'POST',
	        url: actionUrl.action,
	        data: postData,
	        success: function(response){
				//alert('eee');
				var arg = JSON.parse(response);
	        	popdetialHideOther(arg);
	        	window.staticFlag = 0;
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});
	
});
</script>
<script>

    $(document).ready(function() {
        var ifOb;
/*        $('#Module_tab_title').keyup(function() {
            ifOb = $('#myframe').contents();
            ifOb.find('h1').html($('#Module_tab_title').val());
            ifOb.find('.ui-btn-text').html($('#Module_tab_title').val());
        });
*/        $('#showMobile').click(function() {
            if ($('#customizePreview').css('display') == 'none')
                $('#customizePreview').slideDown('slow');
        });
        if ($('input[name="Module[tab_icon]"]').val() != '')
            $('.change_icon_block_image_wrapper img').attr('src', $('input[name="Module[tab_icon]"]').val());

        $('.change_icon_block_tabs li').click(function() {
            if (!$(this).hasClass('active')) {
                var current = $(this).attr('class');
                $('.change_icon_block_tabs li').removeClass('active');
                $(this).addClass('active');
                $('.change_icon_block_tabs_content li').removeClass('current_tab_content');
                $('#' + current).addClass('current_tab_content');
            }
        });

        
        $('.change_icon_block_image_wrapper.image').on('click',function() {
//            alert('asdf');  
          $('.change_icon_block_popup').fadeIn();

       });


       $('.change_icon_block_popup em').click(function() {
            $('.change_icon_block_popup').fadeOut();
        });



        
       /*    $(document).click(function(e) {
            if ($(e.target).parents().filter('.change_icon_block').length == 0) {
                $('.change_icon_block_popup').fadeOut();
            }
        });
 */

        
        $('.change_icon_block_tabs_content img').click(function() {
            $('.change_icon_block_image_wrapper img').attr('src', $(this).attr('src'));
            $('.change_icon_block_popup').fadeOut();
            $('input[name="Module[tab_icon]"]').val($(this).attr('src'));
            //var iframeObj = $('#myframe').contents();
            //iframeObj.find('#tab2 .ui-icon').css('background', 'url("../../' + $('.change_icon_block_image_wrapper img').attr('src') + '")  50% 50% no-repeat');
        });
        /********Iframe-begin********/

    });

</script>
