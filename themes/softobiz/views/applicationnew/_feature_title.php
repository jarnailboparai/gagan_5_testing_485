<script>
$(document).ready(function() {
       
		   if ($('input[name="Module[tab_icon]"]').val() != '')
		   {
            $('#_icon img').attr('src', $('input[name="Module[tab_icon]"]').val());
		   }
    });
    
</script>
<?php  $title = '';
        $module_info = ModuleFile::model()->findByAttributes(array('name' => $model->name));
       	if(count($module_info)){
        if ($model->tab_title == NULL)
            $title = $module_info->title;
        else
            $title = $model->tab_title;
       	}
        if ($title == '')
            $title = $model->name;
		$src = "/members/wizard/themes/softobiz/img/".$module_info->name.".png";
        ?>
        
<div class="individual_title theme_title">
		<span class="content_list_icon" id="_icon"><img src='<?php echo $src;?>'></span>
		<?php echo $title; ?>
		<input class="btn btn-primary cancel_singlepage pull-right" type="button" value="Back to Features List" name="yt1" onclick="feature_listing()">
	<div class="clearfix"></div>
</div>
 
 <?php $this->renderPartial('_title_tab',array('model'=>$model,'flag'=>2));?>
 <?php $this->renderPartial('_theme_setting_content',array('model'=>$model,'flag'=>2));?>
