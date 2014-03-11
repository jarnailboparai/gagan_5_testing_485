<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>

<link
	href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet"
	type="text/css"></link>
<style>
.add_more_video_panel {
	display: block !important;
}
</style>
<div class="single_multi_icons add_more_video_panel">

	<a  class="youtube"	id="myModalVideoYouTube" href="javascript:openAddMoreSelect('a#myModalVideoYouTube')" link="<?php echo CHtml::normalizeUrl(array('videofiles/youtubelist','module_id'=>$module_id,'layout'=>1))?>" >
		<img src="<?php echo $pathurl; ?>/img/youtube.png" alt="youtube"><br>
		YouTube
	</a>
	<a class="custom_icon"	id="myModalVideoCustom" href="javascript:openAddMoreSelect('a#myModalVideoCustom')" link="<?php echo CHtml::normalizeUrl(array('videofiles/create','module_id'=>$module_id,'layout'=>1))?>" >
		<img src="<?php echo $pathurl; ?>/img/custom_icon.png" alt="custom icon"><br>
		Custom 
	</a>
</div>


<script>
function openAddMoreSelect(arg)
{
	var link = jQuery(arg).attr('link');
	var nameModal = jQuery(arg).attr('id');
	jQuery('#myModalSelectVideo').modal('hide');
	//jQuery('#'+nameModal).modal({remote: link});

	 jQuery('#'+nameModal).removeData("modal");
	 jQuery('#'+nameModal).modal({remote: link});
	
	
}

function openCloseSelectOpenVideo()
{
	jQuery('#myModalSelectVideo').modal('hide');
	 jQuery('#myModalVideo').removeData("modal");
	 jQuery('#myModalVideo').modal({remote: '<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$module_id,'layout'=>1))?>'});

}
</script>
