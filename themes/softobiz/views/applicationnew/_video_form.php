<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<link
	rel="stylesheet"
	href="<?= Yii::app()->request->baseUrl; ?>/themes/softobiz/css/customize_module_details.css">
<script
	src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scroller/jquery.mousewheel.js"></script>
<link
	href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet"
	type="text/css"></link>
	<?php // code by sob_k?>
	<link rel="stylesheet" type="text/css" href="<?php echo $pathurl; ?>/js/jqueryeditable/jquery-editable/css/jquery-editable.css" />
	<script type="text/javascript" src="<?php echo $pathurl; ?>/js/jqueryeditable/jquery-editable/js/jquery.poshytip.js"></script>
	<script type="text/javascript" src="<?php echo $pathurl; ?>/js/jqueryeditable/jquery-editable/js/jquery-editable-poshytip.js"></script>	
	<?php // code by sob_k end?>
<script>

jQuery(document).ready(function(){
	
	jQuery('#module-form-video').on('submit',function(e){
		e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('module-form-video');
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
	
});

function openListModalVideo(arg)
{
	var link = jQuery(arg).attr('link');
	var nameModal = jQuery(arg).attr('id');
	//jQuery('#myModalSelectVideo').modal('hide');
	console.log(link,nameModal);
	//jQuery('#'+nameModal).modal({remote: link});
	jQuery('#'+nameModal).modal('show');
	//console.log(link,nameModal);
	//myModalVideo
}



</script>

<!--  Html content for image gallery starts here -->
<div class="row-fluid manage_apps media_gallery tab_gallery">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
            'id' => 'module-form-video',
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
        $video = array('video');
        ?>
	<div class="title_panel">

		<div class="control-group">


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


			<textarea style="display: none" name="Module[description]">
				<?= $description; ?>
			</textarea>
			<textarea style="display: none" name="upload_url">
				<?= $images; ?>
			</textarea>
		</div>

		<!-- 		   <input type="text" placeholder="Title"> -->
		<?php echo $form->textField($model, 'tab_title', array('placeholder' => 'Title', 'value' => $title)); ?>
		<?php echo $form->hiddenField($model, 'tab_icon'); ?>
		<span class="icon_wrapper"> <!--                   <div title="Select Icon" class="select_icon"></div> -->

			<span class="select_icon change_icon_block_image_wrapper video"> <img
				src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/icons_communication_1092.png" />

		</span>

			<div class="change_icon_block_popup">

				<em>X</em>

				<ul class="change_icon_block_tabs">

					<li class="grey_icons active">Grey Icons</li>

					<!--<li class="black_icons">Black Icons</li>-->

					<li class="white_icons">White Icons</li>

				</ul>

				<ul class="change_icon_block_tabs_content">

					<li id="grey_icons" class="current_tab_content"><span><img
							src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/icons_communication_1092.png" />
					</span> <?php for ($i = 1; $i <= 400; $i++) { ?> <span><img
							src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/grey/icon(<?= $i; ?>).png" />
					</span> <?php } ?>
					</li>

					<li id="white_icons"><?php for ($i = 1; $i <= 400; $i++) { ?> <span><img
							src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/white/icon(<?= $i; ?>).png" />
					</span> <?php } ?>
					</li>

				</ul>

			</div>

		</span>


		<!--               <a href="#myModal" role="button" data-toggle="modal" class="btn btn-primary big_btn">Add Images</a> -->

		<a data-target="#myModalVideo"
			href="<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$model->id,'layout'=>1))?>"
			role="button" class="btn btn-danger big_btn" data-toggle="modal">Add
			Videos</a> 
	<!-- <a id="myModalVideo" href="javascript:openListModalVideo('a#myModalVideo')"	link="<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$model->id,'layout'=>1))?>"
			class="btn btn-danger big_btn" >Add	Videos
		</a> -->
		
		<div class="clearfix"></div>
	</div>
	  <div class="photowrapper video <?php if(count($model->subModules)){ ?>show<?php } ?>"  >
		<div class="tab_inner_title">Selected Videos</div>
		<div class="tab_gallery_wrapper scroll2" id="imageListUpdateVideo">
	
			<?php if(count($model->subModules) && ($model->name == 'video')) {?>
	
			<?php echo $this->renderPartial('//videofiles/_videolist' ,array("dataProvider"=>$model->subModules));?>
	
			<?php } ?>
	
		</div>
	</div>
	<div class="button_panel">

		<?php echo CHtml::submitButton('Save', array('class' => 'btn btn-success')); ?>

		<?php echo CHtml::button('Cancel', array('class' => 'btn cancel_singlepage')); ?>

		<!--                 <input type="button" value="Save" class="btn btn-success" name=""> -->
		<!--                 <input type="button" value="Cancel" class="btn cancel_singlepage" name=""> -->
	</div>
	<?php $this->endWidget(); ?>
	<?php //echo $this->renderPartial('_modalupload' ,array("data"=>$model)); ?>
	<?php echo $this->renderPartial('_modaluploadvideo' ,array("data"=>$model)); ?>
	<?php echo $this->renderPartial("//videofiles/_youtubelistmodal" ,array("data"=>$model)); ?>
	<?php echo $this->renderPartial("//videofiles/_videocreatecustom" ,array("data"=>$model)); ?>
	<?php echo $this->renderPartial('//videofiles/_selectvideotype' ,array("data"=>$model)); ?>
	<?php echo $this->renderPartial('//videofiles/_selectvideodetail' ,array("data"=>$model)); ?>
	<?php echo $this->renderPartial('//videofiles/_selectvideodetailgallery' ,array("data"=>$model)); ?>
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

        
        $('.change_icon_block_image_wrapper.video').on('click',function() {
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


    jQuery('.video_title').editable({
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
			data["VideoFiles[id]"] = id[1];
			data["VideoFiles[name]"] = value.value;
			jQuery.post(baseurl+'/index.php?r=videofiles/nameedit',data,function(response){
				//return response.Number.forward_number;
			});
		},
	});

</script>
<script>
	function editdetail(arg)
	{	
		var link = jQuery(arg).attr('link');
		
		var nameModal = jQuery(arg).attr('id');
		jQuery('#myModalVideo').modal('hide');
		//jQuery('#myModalvideogallerydetail').modal({remote: 'http://localhost:9003/members/wizard/index.php?r=tutorial/videodetailgallery&module_id=139',show:true});
		jQuery('#myModalvideogallerydetail').modal({remote: link,show:true});
	}
</script>

