
<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/themes/softobiz/css/customize_module_details.css">
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scroller/jquery.mousewheel.js"></script>
<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css"></link>
<link href="<?php echo $pathurl; ?>/css/icons.css" rel="stylesheet" type="text/css"></link>
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
	       
    
});

</script>
 <?php echo $this->renderPartial('_feature_title',array('model'=>$model));?>
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


                    <textarea style="display: none" name="Module[description]" ><?= $description; ?></textarea>
                    <textarea style="display: none" name="upload_url" ><?= $images; ?></textarea>
                </div>
 
<!-- 		   <input type="text" placeholder="Title"> -->
		    <?php echo $form->textField($model, 'tab_title', array('placeholder' => 'Title', 'value' => $title)); ?>
		    <?php echo $form->hiddenField($model, 'tab_icon'); ?>
		     
             <?php echo $this->render('//mediafiles/index_appicon',array('module_id'=>$model->id));?>
             
<!--               <a href="#myModal" role="button" data-toggle="modal" class="btn btn-primary big_btn">Add Images</a> -->
              
      <a data-target="#myModalMediaImage" href="<?php echo CHtml::normalizeUrl(array('mediafiles/index','module_id'=>$model->id,'layout'=>1))?>" role="button" class="btn btn-primary big_btn" data-toggle="modal" >Add Images</a>

              
              <div class="clearfix"></div>
            
              </div>
              <div class="photowrapper <?php if(count($model->subModules)){ ?>show<?php } ?>"  >
                  <div class="tab_inner_title">Selected Images</div>
                  <div class="tab_gallery_wrapper scroll" id="imageListUpdatePhoto">
                  
	                  <?php if(count($model->subModules) && ($model->name == 'photosub')) {?>
						
				      <?php echo $this->renderPartial('//mediafiles/_imagelist' ,array("dataProvider"=>$model->subModules));?>
	
					  <?php }else{ ?>
					  	No photos Selected yet
					  <?php } ?>

	              </div>
              </div>
                  <div class="button_panel">
                  
                <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-success')); ?>

                <?php echo CHtml::button('Cancel', array('class' => 'btn cancel_singlepage','onclick'=>"feature_listing()")); ?>
                  
<!--                 <input type="button" value="Save" class="btn btn-success" name=""> -->
<!--                 <input type="button" value="Cancel" class="btn cancel_singlepage" name=""> -->
              </div>
                 <?php $this->endWidget(); ?>
                 <?php echo $this->renderPartial('_modalupload' ,array("data"=>$model)); ?>
                 <?php echo $this->renderPartial('_modalimagenameupload',array('module_id'=>$model->id,'layout'=>1));?>
                </div>

<!--  HTML content for image gallery ends here -->

<?php
if (substr($model->name, 0, 7) == 'content')
    $model_name = 'content';
else
    $model_name = $model->name;
?>

<script>
function openCloseMediaImage()
{
	
	jQuery('#myModalMediaImage').modal('hide');
	jQuery('.modal-backdrop').remove();
	jQuery('#myModalMediaImageName').removeData("modal");
	jQuery('#myModalMediaImageName').modal({remote: "<?php echo CHtml::normalizeUrl(array('mediafiles/uploadimage','module_id'=>$model->id,'layout'=>1))?>"});
		
}
 
</script>
