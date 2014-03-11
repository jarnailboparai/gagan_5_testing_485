
<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css"></link>
<style>
.row-fluid.manage_apps.media_gallery.tab_gallery {
	display:block !important;
}
</style>
<div class="row-fluid manage_apps media_gallery tab_gallery" >
<div class="limited_modal2">
<ul id="medialistthumb">
<?php foreach($dataProvider as $data){?>
<li onclick="liUpdateSelect(this);" class="span2 <?php if(in_array($data->id,$selected)){ ?> enabled <?php }  ?>" id="mediafile_<?php echo $data->id ?>" >

			<div class="app_box">
				<div class="app_thumb">
				<?php $r = pathinfo($data->filename);  
					echo CHtml::image(Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/'.$r['filename'].'_256x256.jpg'); ?>
				</div>
				<div class="select_feature">
					<?php echo CHtml::image('images/select_feature.png')?>
				</div>
			</div>
<input <?php if(in_array($data->id,$selected)){ ?>
		checked="checked" <?php }  ?> type="checkbox"  value="<?php echo $data->id ?>"  name="selected[]" style="display:none"  id="checkmedia" />
</li>
<?php } ?>
</ul>
</div>
</div>
<script>
window.imageThumbUrl = '';


	function modalupdate()
	{
		//$(document).ready(function(){
    	 	//jQuery('#myModalThumb').removeData("modal");
    	 	//jQuery('#myModalThumb').modal({remote: '<?php echo CHtml::normalizeUrl(array('mediafiles/imagelistthumb','layout'=>1))?>'});
		//});
	}

	function liUpdateSelect(arg)
	{

			if(jQuery(arg).hasClass('enabled')){
				jQuery(arg).removeClass('enabled');
				
			}else{
				jQuery('#medialistthumb li').removeClass('enabled');
				jQuery('#medialistthumb li input[type="checkbox"]').attr('checked',false);
				jQuery(arg).addClass('enabled');
				jQuery(arg).find('input[type="checkbox"]').attr('checked',"checked");

				window.imageThumbUrl = jQuery(arg);
			}

			
	}

	function closeModalThumb()
	{
		jQuery('#myModalThumb').modal('hide');		
	}
</script>


<?php $this->renderPartial('//mediafiles/_uploadfilethumb');?>
