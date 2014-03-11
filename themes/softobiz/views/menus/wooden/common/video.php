<ul data-role="listview">

    <?php $subMenus = '';
    					foreach($obj->subModules as $sub){

    						$subMenus .= "<li>";

 						if($sub->videomedia->type == 1)
						{
							$keyword = $app_model->master_keyword;
								
							//$subMenus .= "<li style='width:100%; border:1px solid; margin:10px 0px;'><a href='http://www.youtube.com/watch?v={$sub->videomedia->actual_url}'><img src='{$sub->videomedia->thumbnail_url}' width='200px' /></a></li>";
							//$subMenus .= "<div class='gallery-item'><a href='http://www.youtube.com/watch?v={$sub->videomedia->actual_url}'><img src='{$sub->videomedia->thumbnail_url}'  /></a>";
							
							//$subMenus .= '<div class="img_title">Paris City</div>';
							//$subMenus .= '<div class="img_title">'.$sub->videomedia->title.'</div>';
							//$subMenus .= "</div>";
							
							$subMenus .= "<a href='http://www.youtube.com/watch?v={$sub->videomedia->actual_url}'><img src='{$sub->videomedia->thumbnail_url}'  />";
							$subMenus .= "<h2>".$sub->videomedia->title."</h2>";
							$subMenus .= "<p>".$sub->videomedia->description."</p>";
							$subMenus .= "</a>";
						}elseif ($sub->videomedia->type == 2)
						{
							$sour_pathImage = Yii::app()->basePath. '/../mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
							
							//echo $dest_path.'/photo_sub/images/full';
							//echo $dest_path.'/photo_sub/images/thumb';
							
							//if(!file_exists($dest_path.'/video'))
							//	mkdir($dest_path.'/video',0777,true);
							
// 							if(!file_exists($dest_path.'/photo_sub/images/thumb'))
// 								mkdir($dest_path.'/photo_sub/images/thumb',0777,true);
							
							//print_r($sub->videomedia->filemediaImage->attributes);
							//copy($sour_pathImage.$sub->videomedia->filemediaImage->attributes['filename'], $dest_path.'/video/'.$sub->videomedia->filemediaImage->attributes['filename']);
							
							
							//$fil = pathinfo($sub->videomedia->filemedia->attributes['filename']);
							
							//copy($sour_pathImage.'/thumb/'.$fil['filename'].'_128x128.jpg', $dest_path.'/video/'.$sub->filemedia->attributes['filename']);
							//$subMenus .= "<li style='width:100%; border:1px solid; margin:10px 0px;'><a href='{$sub->videomedia->actual_url}'><img src='video/{$sub->videomedia->filemediaImage->attributes['filename']}' width='200px' /></a></li>";
							//$subMenus .= "<div class='gallery-item'><a href='{$sub->videomedia->actual_url}'><img src='video/{$sub->videomedia->filemediaImage->attributes['filename']}' /></a>";
							//$subMenus .= '<div class="img_title">'.$sub->videomedia->title.'</div>';
							//$subMenus .= "</div>";
							
							$serverUrlPath = Yii::app()->getHomeUrl(). Yii::app()->baseUrl;
							
							$serverUrlPath .= '/mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
							
							$subMenus .= "<a href='{$sub->videomedia->mp4_url}'><img src='{$serverUrlPath}{$sub->videomedia->filemediaImage->attributes['filename']}'  />";
							$subMenus .= "<h2>".$sub->videomedia->title."</h2>";
							$subMenus .= "<p>".$sub->videomedia->description."</p>";
							$subMenus .= "</a>";
							
						} 
						
						echo "</li>";
						//$subMenus =  $this->renderPartial("//menus/wooden/common/video",array('module'=>$module),true);
					}
		echo $subMenus;
	?>
</ul>
