<div class="theme_setting" style="display:block;">
<!-- Theme Setting Starts here -->
          <div class="theme_setting">
          <div class="theme_title">Change Theme Background<div class="pull-right">
         
          <a data-target="#myModalMediaImage" href="<?php echo CHtml::normalizeUrl(array('tutorial/imagebackground','layout'=>1))?>" role="button" class="btn btn-primary big_btn" data-toggle="modal" >Modify Background</a>
         <?php /* ?>
          <a href="javascript:void(0);" link="<?php echo CHtml::normalizeUrl(array('mediafiles/imagelistthumbsubpage','layout'=>1))?>"  class="btn btn-info thumbalink" onclick="thumbModalNew(this)" >Change or Choose </a>
           <? */ ?>
          </div></div>
          <div class="theme_content">
          <!-- Splash Copy -->
          <div class="splah_form">
              
              <div class="row-fluid">
              <div class="span7" style="padding-top:34px;">
             <div class="data_at_bottom">
              <div class="landscape_preview">
        <div class="landscape_preview_img"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/land_scape.jpg" alt="splash Image" /> </div>
      </div>
              <a class="btn btn-success" role="button" href="#">Save Background</a>
              </div>
              </div>
              <div class="span5">
          <div class="app_preview custom_preview" style="position:static;margin-top:0px !important;">
        <div class="theme_preview"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_bg.jpg" alt="splash Image" /> </div>
      </div>
        </div>
        </div>
              <div class="clearfix"></div>
              </div>
          
          <!-- Splash copy ends here -->
          </div>
          </div>
          
          <!-- Theme Setting ends here -->
</div>
	<?php  ?>
  <?php echo $this->renderPartial('/applicationnew/_modalupload' ,array("data"=>$model)); ?>
  <?php echo $this->renderPartial('/applicationnew/_modalimagenameupload',array('module_id'=>$model->id,'layout'=>1));?>
  <?  ?>
  <script>
function openCloseMediaImage()
{
	
	jQuery('#myModalMediaImage').modal('hide');
	jQuery('.modal-backdrop').remove();
	jQuery('#myModalMediaImageName').removeData("modal");
	//jQuery('#myModalMediaImageName').modal({remote: "<?php echo CHtml::normalizeUrl(array('mediafiles/uploadimage','module_id'=>$model->id,'layout'=>1))?>"});

	jQuery('#myModalMediaImageName').modal({remote: "<?php echo CHtml::normalizeUrl(array('tutorial/uploadimage_background','layout'=>1))?>"});
		
}

/*
function thumbModalNew(arg){
	//jQuery('#file_upload').uploadifive('destroy');
	console.log('thumbalink',jQuery(arg).attr('link'));
	//jQuery('#myModalThumb').removeData("modal");
	 	jQuery('#myModalThumb').modal({remote: jQuery(arg).attr('link')});
	 	jQuery('#myModalThumb').modal('show');
	 	return false;
	
}
*/
</script>
  
  <?php echo $this->renderPartial('//videofiles/_modalupload' ,array("data"=>$model)); ?>
