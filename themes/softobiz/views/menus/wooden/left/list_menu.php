<div class="right_menu">

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
			}else if ($m['name'] == 'rss_feeds') {
				$link = 'rss_'.$obj->attributes['id'].'.html';
			}else if ($m['name'] == 'aweber') {
				$link = 'aweber_'.$obj->attributes['id'].'.html';
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
		<a class="item link" href="<?php echo $link; ?>"  rel="external" data-ajax="flase"  >
								<?php if($obj->attributes['tab_icon'] != null ){ ?>
									<img src="<?php echo $path_parts['basename']; ?>" />
								<?php }else{ ?>
									<img src="<?php echo 'images/'.strtolower(str_replace(' ','_',$obj->attributes['name']))?>.png " />
								<?php }?>
		</a>
		<a href="<?php echo $link; ?>"  rel="external" data-ajax="flase"  >
				<label><?php echo $title; ?></label>
		</a>
	</div>

	<?php } ?>

</div>
