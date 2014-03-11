<!-- Modal -->
<!-- <a data-target="#myModaltwo" href="<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$data->id,'layout'=>1))?>" role="button" class="btn" data-toggle="modal" >View Media Gallery</a>-->

<!--   <a data-target="#myModaltwo" href="#" role="button" class="btn" data-toggle="modal" >View Media Gallery</a> -->
<div id="myModalVideo" class="modal hide fade custom_modal"
	data-keyboard="true" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<h3 id="myModalLabel" class="pull-left">Video Gallery</h3>
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">x</button>
		<!--     <button class="btn btn-info add_more_videos">Add More</button> -->
		
<?php /* ?>		<a data-target="#myModalVideoYouTube"
			href="<?php echo CHtml::normalizeUrl(array('videofiles/youtubelist','module_id'=>$data->id,'layout'=>1))?>"
			role="button" class="btn btn-info add_more_videos"
			data-toggle="modal">Add More</a> 
		<a data-target="#myModalVideoCustom"
			href="<?php echo CHtml::normalizeUrl(array('videofiles/create','module_id'=>$data->id,'layout'=>1))?>"
			role="button" class="btn btn-info add_more_videos"
			data-toggle="modal">Custom Add More</a>
<?php */?>
		<div class="clearfix"></div>
	</div>
	<div class="modal-body">




		<!-- Video Description Form Ends Here -->
		<!-- Gallery Thumbs Ends Here -->
	</div>
	<div class="modal-footer">
		<a class="btn btn-info add_more_videos" link="<?php echo CHtml::normalizeUrl(array('videofiles/selectvideotype','module_id'=>$data->id,'layout'=>1))?>" href="javascript:void(0)" onclick="openAddMore(this)" >Add More</a>
		<button class="btn btn-success btn-large done_btn" type="button" id="donevideomodal">Done</button>
<!-- 		<button class="btn btn-success">Select Videos</button> -->
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>
