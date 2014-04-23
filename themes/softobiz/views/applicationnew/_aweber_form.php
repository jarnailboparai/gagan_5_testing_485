<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/themes/softobiz/css/customize_module_details.css">
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scroller/jquery.mousewheel.js"></script>
<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css"></link>

<style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
   
 </style>



<script>

jQuery(document).ready(function(){
	
	jQuery('#module-form-aweber').on('submit',function(e){
		nicEditors.findEditor('description').saveContent();
		nicEditors.findEditor('images').saveContent();
		e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('module-form-aweber');
	 	console.log(actionUrl.action);
			
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

	
	
});

</script>

<?php echo $this->renderPartial('_feature_title',array('model'=>$model));?>

<!--  Html content for image gallery starts here -->

<div class="row-fluid manage_apps media_gallery tab_gallery location_form aweber_form">
     <?php 
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'module-form-aweber',
        	'action'=> CHtml::normalizeUrl(array("tutorial/aweber","module_id"=>$model->id)),
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data',
            	//'onsubmit' => 'return customizemodulenew();'
            ),
        ));
		
      
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
      
        $photos_arrsub = array('photosub');
        $location = array('location');
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
                    if ($model->rss_feed_url != NULL)
                        $rss_feed_url = $model->rss_feed_url;
                    else
                        $rss_feed_url = '';
                    ?>
                    <?php
                    if ($model->images != NULL)
                        $images = $model->images;
                    else
                        $images = "Thanks. Check your inbox for our email. We will be sending you the information now. If you don't see it then be sure to check your spam folder.";
                    ?>
                     <?php
                    if ($model->web_page_url != NULL)
                        $web_page_url = $model->web_page_url;
                    else
                        $web_page_url = "We respect your privacy. Your email will never be sold. We hate spam as much as you. From time to time we will also email you with more tips and information.";
                    ?>
                    
                     <?php
                    if ($aweberapplication_id != NULL)
                        $model->flickr_keyword = $aweberapplication_id;
                    else
                        $model->flickr_keyword = '';
                    ?>


                    
                </div>
 
		    <?php echo $form->textField($model, 'tab_title', array('placeholder' => 'Title', 'value' => $title)); ?>
		    <?php echo $form->hiddenField($model, 'tab_icon'); ?>
		    <?php echo $form->hiddenField($model, 'flickr_keyword'); ?>
		     <span class="icon_wrapper">

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
              
              <div class="address_map">
<!--              		<textarea name="" cols="" rows="" placeholder="Enter Address"></textarea> -->
             		

           
   		 <!-- 
				<textarea placeholder="Description" id="description" type="text"  name="Module[description]"><?= $description; ?></textarea>
		-->
		
		<!-- Editor Starts here -->
        <div class="row-fluid">
				<div class="span12">
				<div class="msg_wrapper">
				<div class="msg_title">Description</div>
		<div class="custom_editor">
		<div class="content_editor">
	<textarea id="description" name="Module[description]" style="width: 100%;height: 300px" cols="100"><?= $model->description ?></textarea>
				<script>
                    var nicedt;
                    //<![CDATA[
                  /*  bkLib.onDomLoaded(function() {
                        nicedt = new nicEditor({maxHeight: 300, fullPanel: true}).panelInstance('editor1');
                        nicedt.instanceById('editor1').setContent($('textarea[name="Module[description]"]').val());
                    }); */
                    //]]>
                    function myBk(){
                    	nicedt = new nicEditor({maxHeight: 300, fullPanel: true}).panelInstance('description');
                       // nicedt.instanceById('editor1').setContent($('textarea[name="Module[description]"]').val());
                    
               		}
                		myBk();
					
              </script>
	
	</div>
	</div>
    </div>
    </div>
    </div>
				<!-- Editor Ends here -->
				
				
				
				
				
				
				
				<div class="row-fluid">
				<div class="span12">
				<div class="msg_wrapper">
				<div class="msg_title">Thank you Page Text</div>
				<!--  <textarea placeholder="Thank you Message" id="images" type="text"  name="Module[images]"><?= $images; ?></textarea>-->             
                <!-- Editor Starts here -->
				<div class="custom_editor">
				<div class="content_editor">
					<textarea id="images" name="Module[images]" style="width: 100%;height: 300px" cols="100"><?= $images ?></textarea>
				<script>
                    var nicedt;
                    //<![CDATA[
                  /*  bkLib.onDomLoaded(function() {
                        nicedt = new nicEditor({maxHeight: 300, fullPanel: true}).panelInstance('editor1');
                        nicedt.instanceById('editor1').setContent($('textarea[name="Module[description]"]').val());
                    }); */
                    //]]>
                    function myBk_text(){
                    	nicedt = new nicEditor({maxHeight: 300, fullPanel: true}).panelInstance('images');
                       // nicedt.instanceById('editor1').setContent($('textarea[name="Module[description]"]').val());
                    
               		}
                    myBk_text();
					
              </script>
	
	</div>
	</div>
				<!-- Editor Ends here -->
                
                </div>
                </div>
                </div>
                <div class="row-fluid">
				<div class="span12">
                <div class="msg_wrapper">
                <div class="msg_title">Legal Text</div>
                <textarea placeholder="Legal Text" id="web_page_url" type="text"  name="Module[web_page_url]"><?=  $web_page_url; ?></textarea>
                </div>
                </div> 
                </div>
                <div class="aweber_activate">
                <div class="aweber_title">API Intergration</div>
                <div class="list_wrap">
                  <?php
             if(count($model_weber) && !empty($data) && $aweberapplication_id!=""){
		        echo $form->labelEx($model,'Listing',array('class'=>'aweber_label'));
		        echo $form->listBox($model,'flickr_id', $data, $htmlOptions);
		      }
  			  ?>  
  			   <!-- activation button starts here -->
  			  
		
		<?php if($aweberapplication_id=="" || empty($data))
		{ ?>	
		
		<a class='btn btn-info large-btn' onclick="feature_listing();" target="_blank" href='<?php echo CHtml::normalizeUrl(array('aweber/index'))?>' >Activate Aweber Account</a>
		<?php } ?>
	
			
  			  
  	<!-- activation button ends here -->
  			 </div>  
  			
  			 
  		      
              </div>
             </div>
              
                  <div class="button_panel">
                  
                <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-success')); ?>

                 <?php echo CHtml::button('Cancel', array('class' => 'btn cancel_singlepage','onclick'=>"feature_listing()")); ?>
                  

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

        
        $('.change_icon_block_image_wrapper.image').on('click',function() {

          $('.change_icon_block_popup').fadeIn();

       });


       $('.change_icon_block_popup em').click(function() {
            $('.change_icon_block_popup').fadeOut();
        });



        
        $('.change_icon_block_tabs_content img').click(function() {
            $('.change_icon_block_image_wrapper img').attr('src', $(this).attr('src'));
            $('.change_icon_block_popup').fadeOut();
            $('input[name="Module[tab_icon]"]').val($(this).attr('src'));
                  });


        $('.aweber_title').click(function() {
            $('.list_wrap').slideToggle();
            
		  });

        

    });

    
  

</script>

