<!-- Modal -->
<!-- <a data-target="#myModaltwo" href="<?php echo CHtml::normalizeUrl(array('videofiles/selecvideo','module_id'=>$data->id,'layout'=>1))?>" role="button" class="btn" data-toggle="modal" >View Media Gallery</a>-->

<!--   <a data-target="#myModaltwo" href="#" role="button" class="btn" data-toggle="modal" >View Media Gallery</a> -->
<div id="myModalSelectVideo" class="modal hide fade custom_modal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabelVideoYouTube" aria-hidden="true">
	<div class="modal-header">
		<h3 id="myModalLabelVideoYouTube" class="pull-left">Video Gallery</h3>
	<!-- 	<button type="button" class="close" onclick="openCloseSelectOpenVideo()" >x</button>  -->
		<button class="close"  type="button" data-dismiss="modal" aria-hidden="true"> x </button>
		<div class="clearfix"></div>
	</div>
	<div class="modal-body"></div>
</div>
