<!-- Modal -->
 <a data-target="#myModaltwo" href="<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$data->id,'layout'=>1))?>" role="button" class="btn" data-toggle="modal" >View Media Gallery</a>

<!--   <a data-target="#myModaltwo" href="#" role="button" class="btn" data-toggle="modal" >View Media Gallery</a> -->
<div id="myModaltwo" class="modal hide fade custom_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
    <h3 id="myModalLabel" class="pull-left">Video Gallery</h3>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <button class="btn btn-info pull-right add_more_videos">Add More</button>
    <div class="clearfix"></div>
  </div>
  <div class="modal-body"> 

  </div>
      <div class="modal-footer">
      <button class="btn btn-success btn-large done_btn" type="button" id="formIdSubmit" >Done</button>
    <button class="btn btn-success">Select Videos</button>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
  </div>
    </div>
