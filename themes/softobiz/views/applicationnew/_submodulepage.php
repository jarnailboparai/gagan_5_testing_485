<script><?php if(!$flagC) { ?>
jQuery(document).ready(function(){
	
	jQuery('#module-form-sub').submit(function(e){
		 e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('module-form-sub');
	   // alert(postData);
	   // alert(actionUrl);
		
	    $.ajax({
	        type: 'POST',
	        url: actionUrl.action,
	        data: postData,
	        success: function(response){
				//alert('eee');
				var arg = JSON.parse(response);
	        	//popdetialHideOther(arg);
				popdetialHideOtherSub(arg,'<?php echo $model->id; ?>');
				//$("#addSubPage").show();
	        	
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});
	
}); 
<?php }else{ ?>

jQuery(document).ready(function(){
	
	jQuery('#module-form-sub').submit(function(e){
		 e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('module-form-sub');
	   // alert(postData);
	   // alert(actionUrl);
		
	    $.ajax({
	        type: 'POST',
	        url: actionUrl.action,
	        data: postData,
	        success: function(response){
				//alert('eee');
				var arg = JSON.parse(response);
	        	//popdetialHideOther(arg);
				//popdetialHideOtherSub(arg);
				addNewLi(arg);
				$("#addSubPage").show();
				$("#addSubPageForm").html('');
				$("#addSubPage").removeClass("make_abso");
				
	        	
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});
	
}); 

<?php } ?>
</script>
<div class="single_page">
        <!--                <form class="form-horizontal" action="./Customize Module Detail_files/Customize Module Detail.htm" method="post" autocomplete="off" enctype="multipart/form-data">-->
        <?php
        if($flagC)
        {
	        $form = $this->beginWidget('CActiveForm', array(
	            'id' => 'module-form-sub',
	        	'action'=> CHtml::normalizeUrl(array('submodules/create')),
	            'enableAjaxValidation' => false,
	            'htmlOptions' => array(
	                'class' => 'form-horizontal',
	                'enctype' => 'multipart/form-data',
	            	'onsubmit' => 'return customizemodulenew();'
	            ),
	        ));
	        
	     ?><?php echo $form->hiddenField($model,'name',array('size'=>50,'maxlength'=>50,'value'=>'staticpage')); ?>
		<?php echo $form->hiddenField($model,'module_id',array('size'=>50,'maxlength'=>50,'value'=>$data->id)); ?>
		<?php echo $form->hiddenField($model,'activated',array('size'=>50,'maxlength'=>50,'value'=>'yes')); ?>
		
		<?php 
        
        }else{
	        $form = $this->beginWidget('CActiveForm', array(
	        		'id' => 'module-form-sub',
	        		//'action'=> CHtml::normalizeUrl(array('submodules/update')),
	        		'enableAjaxValidation' => false,
	        		'htmlOptions' => array(
	        				'class' => 'form-horizontal',
	        				'enctype' => 'multipart/form-data',
	        				'onsubmit' => 'return customizemodulenew();'
	        		),
	        ));
       
        
        ?><?php echo $form->hiddenField($model,'name',array('size'=>50,'maxlength'=>50,'value'=>'staticpage')); ?>
        		<?php echo $form->hiddenField($model,'module_id',array('size'=>50,'maxlength'=>50,'value'=>$model->module_id)); ?>
        		<?php echo $form->hiddenField($model,'activated',array('size'=>50,'maxlength'=>50,'value'=>'yes')); ?>
         
        <?php }		
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
	<table class="title_table subpagethumb_wrap">
		<tr>
			<td>
<!-- 			<input type="text" placeholder="Title"> -->
				<?php echo $form->textField($model, 'tab_title', array( 'placeholder'=>"Title",'value' => $title)); ?>
			</td>
			<td>
			 <?php echo $form->hiddenField($model, 'tab_icon'); ?>
			<div class="subpagethumb">
				<div class="thumb_panel">
					<div class="thumb" id="thumbImage">
						<?php if(!isset($model->tab_icon)){ ?>
						<?php echo CHtml::image('images/no_thumb.jpg','',array())?>
						<?php }else{
							//print_r($model->filemediaImage);
							//echo CHtml::image('images/thumb.jpg','no thumb',array());
							 //$r = pathinfo($model->tab_icon);   
							 echo CHtml::image($model->tab_icon); 
						}?>
					</div>
					<div class="thumb_btn">
					 		<a href="javascript:void(0);" link="<?php echo CHtml::normalizeUrl(array('mediafiles/imagelistthumbsubpage','layout'=>1,'select'=>$model->tab_title))?>"  class="btn btn-info thumbalink" onclick="thumbModalNew(this)" >Change or Choose </a>

						<?php //echo $form->hiddenField($model,'tab_title'); ?>

					</div>
				</div>
			</div>			 
			 <?php /* ?>
			<span class="icon_wrapper">
<!--                   <div title="Select Icon" class="select_icon"></div> -->
                  
                  <span class="select_icon change_icon_block_image_wrapper subpage">

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
             
             <?php */ ?>
			</td>
		</tr>
	</table>
	                    <?php
                    if ($model->articles != NULL)
                        $article = $model->articles;
                    else
                        $article = '';
                    ?>
<textarea placeholder="Short Description" maxlength="150" id="short_description" class= "short_description" type="text"  name="SubModules[articles]"><?= $article; ?></textarea>

	<div class="content_editor">
	<textarea id="editorsub<?php echo $model->id ?>" name="SubModules[description]" style="width: 100%;height: 300px" cols="100"><?= $model->description ?></textarea>
				<script>
                    var nicedt;
                    //<![CDATA[
                  /*  bkLib.onDomLoaded(function() {
                        nicedt = new nicEditor({maxHeight: 300, fullPanel: true}).panelInstance('editor1');
                        nicedt.instanceById('editor1').setContent($('textarea[name="Module[description]"]').val());
                    }); */
                    //]]>
                    function myBk(){
                    	nicedt = new nicEditor({maxHeight: 300, fullPanel: true}).panelInstance('editorsub<?php echo $model->id ?>');
                       // nicedt.instanceById('editor1').setContent($('textarea[name="Module[description]"]').val());
                    
               		}
                		myBk();
					
              </script>
	
	</div>
	<div class="button_panel">
		<?php echo CHtml::submitButton('Save', array('onclick'=>"nicEditors.findEditor('editorsub$model->id').saveContent();",'class' => 'btn btn-success')); ?>
		<?php if(!$flagC){
			echo CHtml::button('Cancel', array('class' => 'btn cancel_singlepage','onclick'=>"$('#submodule_$model->id').find('#formId').remove();"));
		}else{
			echo CHtml::button('Cancel', array('class' => 'btn cancel_singlepage','onclick'=>'$("#addSubPageForm").html("");$("#addSubPage").removeClass("make_abso");$("#addSubPage").show();'));
		} ?>
		<?php //echo CHtml::link('Return to Tab List', array('/application/customizemodules'), array('class' => 'btn btn-large btn_radius btn-primary4')); ?>
		
	</div>
	<?php $this->endWidget(); ?>
</div>





<?php
if (substr($model->name, 0, 7) == 'content')
    $model_name = 'content';
else
    $model_name = $model->name;
?>
<script>

    $(document).ready(function() {
        var ifOb;
        $('#showMobile').click(function() {
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

        
        $('.change_icon_block_image_wrapper.subpage').on('click',function() {
//            alert('asdf');  
          $('.change_icon_block_popup').fadeIn();

       });


       $('.change_icon_block_popup em').click(function() {
            $('.change_icon_block_popup').fadeOut();
        });

   
        $('.change_icon_block_tabs_content img').click(function() {
            $('.change_icon_block_image_wrapper img').attr('src', $(this).attr('src'));
            $('.change_icon_block_popup').fadeOut();
            $('input[name="Module[tab_icon]"]').val($(this).attr('src'));
            //var iframeObj = $('#myframe').contents();
            //iframeObj.find('#tab2 .ui-icon').css('background', 'url("../../' + $('.change_icon_block_image_wrapper img').attr('src') + '")  50% 50% no-repeat');
        });
        /********Iframe-begin********/

    });

    function thumbModalNew(arg){
		//jQuery('#file_upload').uploadifive('destroy');
		console.log('thumbalink',jQuery(arg).attr('link'));
		//jQuery('#myModalThumb').removeData("modal");
   	 	jQuery('#myModalThumb').modal({remote: jQuery(arg).attr('link')});
   	 	jQuery('#myModalThumb').modal('show');
   	 	return false;
		
	}

</script>

<?php echo $this->renderPartial('//videofiles/_modalupload' ,array("data"=>$model)); ?>


