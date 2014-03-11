<?php echo $this->renderPartial('_formvideo', array('model'=>$model,'module_id'=>$module_id)); ?>
<script>
function openCloseCustomOpenVideo()
{
	jQuery('#myModalVideoCustom').modal('hide');
	 jQuery('#myModalVideo').removeData("modal");
	 jQuery('#myModalVideo').modal({remote: '<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$module_id,'layout'=>1))?>'});

}
</script>
