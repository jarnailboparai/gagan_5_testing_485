<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/themes/softobiz/css/customize_module_details.css">
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scroller/jquery.mousewheel.js"></script>
<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css"></link>

<script>

jQuery(document).ready(function(){
	
	jQuery('#module-form-photo').on('submit',function(e){
		e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('module-form-photo');
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
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});

	//google.maps.event.addDomListener(window, 'load', initialize);
	//google.maps.event.addDomListener(window, 'load', codeAddress); 
	
});

</script>



<!--  Html content for image gallery starts here -->
<div class="row-fluid manage_apps media_gallery tab_gallery">
     <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'module-form-photo',
        	//'action'=> 'index.php?r=applicationnew/customize_modules_details',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data',
            	//'onsubmit' => 'return customizemodulenew();'
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
        $photos_arrsub = array('photosub');
        $location = array('location');
         $notification = array('notification');
        ?>
        <div class="title_panel">
        
         <div class="control-group" >


                    <?php
                    if ($model->description != NULL)
                        $description = $model->description;
                    else
                        $description = '';
                    ?>
                    <?php
                    if ($model->images != NULL)
                        $images = $model->images;
                    else
                        $images = '';
                    ?>


                  <!--   <textarea style="display: none" name="Module[description]" ><?= $description; ?></textarea>  -->
                    <textarea style="display: none" name="upload_url" ><?= $images; ?></textarea>
                </div>
 
<!-- 		   <input type="text" placeholder="Title"> -->
		    <?php echo $form->textField($model, 'tab_title', array('placeholder' => 'Title', 'value' => $title)); ?>
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
             
            
              <div class="clearfix"></div>
              </div>
              <div class="pushnotification">
              <div class="span7">
              
<!--               <input type="text" placeholder="Name" class=""> -->
<!--               <input type="text" placeholder="Email Address" class=""> -->
<!--               <input type="text" placeholder="Sender ID" class=""> -->
<!--               <input type="text" placeholder="Google API Key" class=""> -->
<!--               <label>APN Production Certificate</label> -->
<!--               <input type="file" name=""> -->
<!--               <label>APN Mobile Provision Certificate</label> -->
<!--               <input type="file" name=""> -->
<!--               <a role="button" class="btn btn-warning btn-lg pull-right">Submit</a> -->
              
              
              
             
              
              <?php if (in_array($model->name, $notification)) { ?>
<!--                 <div class="control-group">  -->
<!--                     <label class="control-label">Name:</label> -->
<!--                     <div class="controls"> -->
                        <?php echo $form->textField($notificationModel, 'name' , array( 'placeholder'=>"Name" )); ?>
<!--                     </div> -->
<!--                     <label class="control-label">Email:</label> -->
<!--                     <div class="controls"> -->
                        <?php echo $form->textField($notificationModel, 'email', array( 'placeholder'=>"Email" )); ?>
<!--                     </div> -->
<!--                     <label class="control-label">Sender ID:</label> -->
<!--                     <div class="controls"> -->
                        <?php echo $form->textField($notificationModel, 'sender_id', array( "placeholder"=>"Sender ID" )); ?>
<!--                     </div> -->
<!--                     <label class="control-label">Google API Key:</label> -->
<!--                     <div class="controls"> -->
                        <?php echo $form->textField($notificationModel, 'google_api_key', array( "placeholder"=>"Google API Key" )); ?>
<!--                     </div> -->
<!--                     <label class="control-label">Apn Production certificate:</label> -->
<!--                     <div class="controls"> -->
                        <label>APN Production Certificate</label> 
                        <?php echo $form->fileField($notificationModel, 'certification_push_pem_path', array('class' => 'input-file', 'id' => 'uploadedFile')); ?>
<!--                     </div> -->
<!--                     <div style="clear: both"></div> -->
<!--                     <label class="control-label">Apn Mobile Provision certificate:</label> -->
<!--                     <div class="controls"> -->
                        <label>APN Mobile Provision Certificate</label>
                        <?php echo $form->fileField($notificationModel, 'apn_mobileprovision', array('class' => 'input-file', 'id' => 'uploadedFile')); ?>
<!--                     </div> -->
<!--                 </div> -->
            <?php } ?>
             <div class="clearfix"></div>
            </div>
              </div>
               <div class="clearfix"></div>
                         <?php /* if (in_array($model->name, $notification)) { ?>
                <div class="control-group">
                    <label class="control-label">Name:</label>
                    <div class="controls">
                        <?php echo $form->textField($notificationModel, 'name', array('class' => 'span12')); ?>
                    </div>
                    <label class="control-label">Email:</label>
                    <div class="controls">
                        <?php echo $form->textField($notificationModel, 'email', array('class' => 'span12')); ?>
                    </div>
                    <label class="control-label">Sender ID:</label>
                    <div class="controls">
                        <?php echo $form->textField($notificationModel, 'sender_id', array('class' => 'span12')); ?>
                    </div>
                    <label class="control-label">Google API Key:</label>
                    <div class="controls">
                        <?php echo $form->textField($notificationModel, 'google_api_key', array('class' => 'span12')); ?>
                    </div>
                    <label class="control-label">Apn Production certificate:</label>
                    <div class="controls">
                        <?php echo $form->fileField($notificationModel, 'certification_push_pem_path', array('class' => 'input-file', 'id' => 'uploadedFile')); ?>
                    </div>
                    <div style=" clear: both"></div>
                    <label class="control-label">Apn Mobile Provision certificate:</label>
                    <div class="controls">
                        <?php echo $form->fileField($notificationModel, 'apn_mobileprovision', array('class' => 'input-file', 'id' => 'uploadedFile')); ?>
                    </div>
                </div>
            <?php } */ ?>
              
                  <div class="button_panel">
                  
                <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-success')); ?>

                <?php echo CHtml::button('Cancel', array('class' => 'btn cancel_singlepage')); ?>
                  
<!--                 <input type="button" value="Save" class="btn btn-success" name=""> -->
<!--                 <input type="button" value="Cancel" class="btn cancel_singlepage" name=""> -->
              </div>
                 <?php $this->endWidget(); ?>
                
                </div>

<!--  HTML content for image gallery ends here -->

<?php
if (substr($model->name, 0, 7) == 'content')
    $model_name = 'content';
else
    $model_name = $model->name;
?>
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

   // google.maps.event.trigger(map, "resize");

</script>
