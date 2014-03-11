<div class="grid_menu">

	<?php $menu='';
	foreach ($module as $obj) {
		if ($obj->attributes['name'] == 'Admob')
		continue;
	?>
		<div class="app_feature_list">
	<?php 				
			$m = $obj->attributes;
				
			$file = ModuleFile::model()->findByAttributes(array('name' => $m['name']));
				
			if ($m['name'] == 'facebook' || $m['name'] == 'twitter') {
				$username = $m['username'];
				$link = str_replace("%username%", $username, $file->file);
			} else if ($m['name'] == 'twitter(keyword)') {
				$keyword = ($obj->attributes['keyword'] != '') ? $obj->attributes['keyword'] : $app_model->master_keyword;
				$link = str_replace("%keyword%", $keyword, $file->file);
			} else if ($m['name'] == 'web_page') {
				$link = $obj->attributes['web_page_url'];
			} else if ($m['name'] == 'staticpage') {
				$link = 'staticpage_'.$obj->attributes['id'].'.html';
			} else if ($m['name'] == 'photosub') {
				$link = 'photosub_'.$obj->attributes['id'].'.html';
			} else if ($m['name'] == 'video') {
				$link = 'video_'.$obj->attributes['id'].'.html';
			}else if ($m['name'] == 'location') {
				$link = 'location_'.$obj->attributes['id'].'.html';
			}
			else {
				$link = $file->file;
			}
				
			if (strpos($obj->attributes['name'], 'content') !== false) {

				if ($link == 'content.html') {
					$link = ($content_File != '') ? $content_File : 'content1.html';
				} else {
						$link = $obj->attributes['name'] . '.html';
					}
			}
				
			if ($m['tab_title'] == NULL)
				$title = $file->title;
			else
				$title = $m['tab_title'];
			
			$path_parts = pathinfo($obj->attributes['tab_icon']);

	?>
		<a  rel="external" data-ajax="flase"  class="item link" href="<?php echo $link; ?>">
								<?php if($obj->attributes['tab_icon'] != null ){ ?>
									<img src="<?php echo $path_parts['basename']; ?>" />
								<?php }else{ ?>
									<img src="<?php echo 'images/'.strtolower(str_replace(' ','_',$obj->attributes['name']))?>.png " />
								<?php }?>
		</a>
		<a  rel="external" data-ajax="flase"  href="<?php echo $link; ?>">
				<label><?php echo $title; ?></label>
		</a>
	</div>

	<?php } ?>

     
</div>

<!-- <a onclick="window.open('video_1895.html','_self', 'location=yes')" class="ui-link ui-btn ui-icon-custom ui-btn-icon-top ui-btn-active" data-gourl="video_1895.html" rel="external" data-icon="custom" id="tab2" href="video_1895.html">Videos</a> -->
