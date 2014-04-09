
<div class="theme_image_background">
    <a href="#" class="btn pull-right" onclick="bg_color_cancel(<?php echo $flag;?>,<?php echo $id;?>)">Back to Theme Settings</a>
    <div class="row-fluid">
      <div class="span3">
        <div class="background_thumb_port"> <img src="<?php echo $url_port;?>"> </div>
      </div>
      <div class="span9">
        <div class="bg_notification">Smartphone Portrait 640x960</div>
        <div class="bg_control"> <a data-target="#myModalMediaImageBg" href="<?php echo CHtml::normalizeUrl(array('tutorial/imagebackground','layout'=>1,'type'=>'1','module_id'=>$module_id,'app_id'=>$app_id,'sub_module_id'=>$sub_module_id))?>" role="button" class="btn btn-success" data-toggle="modal" >Select Background Image</a>
        <a href="#" class="btn btn-danger" onclick="remove_app_bg(<?php echo $image_id;?>,1)">Remove</a> </div>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span3">
        <div class="background_thumb_land"> <img src="<?php echo $url_land?>"> </div>
      </div>
      <div class="span9">
        <div class="bg_notification">Smartphone Portrait 960X640 </div>
        <div class="bg_control"> <a data-target="#myModalMediaImageBg" href="<?php echo CHtml::normalizeUrl(array('tutorial/imagebackground','layout'=>1,'type'=>'2','module_id'=>$module_id,'app_id'=>$app_id,'sub_module_id'=>$sub_module_id))?>" role="button" class="btn btn-success" data-toggle="modal" >Select Background Image</a>
        <a href="#" class="btn btn-danger" onclick="remove_app_bg(<?php echo $image_id;?>,2)">Remove</a> </div>
      </div>
      
    </div>
  </div>
