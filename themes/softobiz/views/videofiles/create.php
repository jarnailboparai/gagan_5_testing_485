<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css"></link>
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
