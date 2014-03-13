<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css"></link>
<script src="<?php echo $pathurl; ?>/js/validate.js"></script>
<script>
$().ready(function() {
	// validate signup form on keyup and submit
	$("#video-files-formaqsw").validate({
		rules: {
			"VideoFiles[title]": "required",	
			"VideoFiles[description]": "required", 	
			"VideoFiles[actual_url]": "required",	
			"VideoFiles[mp4_url]": "required",
			"VideoFiles[threegp_url]": "required",
			"VideoFiles[m4v]": "required",	
			//"VideoFiles[thumbnail_url]":"required",
		},
		messages: {
			"VideoFiles[title]": "Please enter Title",
			"VideoFiles[description]": "Please enter Description",
			"VideoFiles[actual_url]": "Please enter video link",
			"VideoFiles[mp4_url]": "Please enter MP4 video link",
			"VideoFiles[threegp_url]": "Please enter 3GP video link",
			"VideoFiles[m4v]": "Please enter M4V video link",
			//"VideoFiles[thumbnail_url]": "please add file for thumb"
		}
	});

});

</script>

<?php echo $this->renderPartial('_formvideo', array('model'=>$model,'module_id'=>$module_id)); ?>
<script>
function openCloseCustomOpenVideo()
{
	jQuery('#myModalVideoCustom').modal('hide');
	jQuery('#myModalSelectVideo').modal('show');
	// jQuery('#myModalVideo').removeData("modal");
	// jQuery('#myModalVideo').modal({remote: '<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$module_id,'layout'=>1))?>'});

}
</script>
