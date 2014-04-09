 <?php if($flag==1) { 
  $this->renderPartial('_title_tab_app',array('model'=>$model,'flag'=>$flag));
  $this->renderPartial('_theme_setting_content_app',array('model'=>$model,'flag'=>$flag));
 }
 elseif ($flag==3)
 {
 	
 	if($flagC!=1)
 	{
 	$this->renderPartial('_title_tab_sub',array('model'=>$model,'flag'=>$flag));
 	$this->renderPartial('_theme_setting_content_sub',array('model'=>$model,'flag'=>$flag));
 	}
 }
 
 ?>
