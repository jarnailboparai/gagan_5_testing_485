    <?php $subMenus = '<ul data-role="listview">';
    					foreach($obj->subModules as $sub){

    					$subMenus .= "<li>";

 						if($sub->videomedia->type == 1)
						{
							$keyword = $app_model->master_keyword;
								
							//$subMenus .= "<a href='http://www.youtube.com/watch?v={$sub->videomedia->actual_url}'><img src='{$sub->videomedia->thumbnail_url}'  />";
							$subMenus .= "<a href='#popupVideo_{$sub->videomedia->id}' data-rel='popup' data-position-to='window' ><img src='{$sub->videomedia->thumbnail_url}'  />";
							$subMenus .= "<h2>".substr($sub->videomedia->title,0,100)."</h2>";
							$subMenus .= "<p>".substr($sub->videomedia->description,0,100)."</p>";
							$subMenus .= "</a>";
							
						}elseif ($sub->videomedia->type == 2)
						{
							$sour_pathImage = Yii::app()->basePath. '/../mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
							
							$serverUrlPath = Yii::app()->getHomeUrl(). Yii::app()->baseUrl;
							
							$serverUrlPath .= '/mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
							
							//$subMenus .= "<a href='{$sub->videomedia->mp4_url}'><img src='{$serverUrlPath}{$sub->videomedia->filemediaImage->attributes['filename']}'  />";
							$subMenus .= "<a href='#popupVideo_{$sub->videomedia->id}' data-rel='popup' data-position-to='window' ><img src='{$serverUrlPath}{$sub->videomedia->filemediaImage->attributes['filename']}'  />";
							$subMenus .= "<h2>".substr($sub->videomedia->title,0,100)."</h2>";
							$subMenus .= "<p>".substr($sub->videomedia->description,0,100)."</p>";
							$subMenus .= "</a>";
							
						} 
						
						$subMenus .= "</li>";
						//$subMenus =  $this->renderPartial("//menus/wooden/common/video",array('module'=>$module),true);
					}
		$subMenus .= '</ul>';	
		
		$frameVideo = '';
		
		foreach($obj->subModules as $sub){
		
			//$subMenus .= "<li>";
		
			if($sub->videomedia->type == 1)
			{
// 				$keyword = $app_model->master_keyword;
		
// 				$subMenus .= "<a href='http://www.youtube.com/watch?v={$sub->videomedia->actual_url}'><img src='{$sub->videomedia->thumbnail_url}'  />";
// 				$subMenus .= "<h2>".$sub->videomedia->title."</h2>";
// 				$subMenus .= "<p>".$sub->videomedia->description."</p>";
// 				$subMenus .= "</a>";
				

				$frameVideo .= '<div data-role="popup" id="popupVideo_'.$sub->videomedia->id.'" data-overlay-theme="b" data-theme="a" data-tolerance="0,0" class="ui-content">';
				$frameVideo .= '<iframe width="100%" height="315" src="http://www.youtube.com/embed/'.$sub->videomedia->actual_url.'?rel=0" frameborder="0" allowfullscreen></iframe>';
				$frameVideo .= '<a href="#" data-rel="back" class="ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>';
				$frameVideo .= '</div>';
					
			}elseif ($sub->videomedia->type == 2)
			{
				$sour_pathImage = Yii::app()->basePath. '/../mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
					
				$serverUrlPath = Yii::app()->getHomeUrl(). Yii::app()->baseUrl;
					
				$serverUrlPath .= '/mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
					
// 				$subMenus .= "<a href='{$sub->videomedia->mp4_url}'><img src='{$serverUrlPath}{$sub->videomedia->filemediaImage->attributes['filename']}'  />";
// 				$subMenus .= "<h2>".$sub->videomedia->title."</h2>";
// 				$subMenus .= "<p>".$sub->videomedia->description."</p>";
// 				$subMenus .= "</a>";
				
				$frameVideo .= '<div data-role="popup" id="popupVideo_'.$sub->videomedia->id.'" data-overlay-theme="b" data-theme="a" data-tolerance="0,0" class="ui-content">';
				$frameVideo .= '<iframe width="100%" height="315" src="'.$sub->videomedia->mp4_url.'" frameborder="0" allowfullscreen></iframe>';
				$frameVideo .= '<a href="#" data-rel="back" class="ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>';
				$frameVideo .= '</div>';
					
			}
		
			//echo "</li>";
			//$subMenus =  $this->renderPartial("//menus/wooden/common/video",array('module'=>$module),true);
		}

		$subMenus .= $frameVideo;
		
		echo $subMenus;
	?>

