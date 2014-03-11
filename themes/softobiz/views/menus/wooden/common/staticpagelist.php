<div class="staticPageList">
<ul data-role="listview" >
<?php 
foreach($obj->subModules as $sub){

	$keyword = $app_model->master_keyword;

	//$str = implode("\n", file($src_path . '/staticpage.html'));

	$str = implode("\n", file($src_path . '/../common/staticpage.html'));

	$nameFile = '/staticpage_'.$obj->id.'_'.$sub->id.'.html';

	$urlName = 'staticpage_'.$obj->id.'_'.$sub->id.'.html';

	$fp = fopen($dest_path .$nameFile, 'w');

	$str = str_replace('<div class="staticpage_content"></div>', $sub->attributes['description'], $str);

	if ($sub->attributes['tab_title'] != NULL)
		$str = str_replace("<h1>Static Page</h1>", "<h1>" . $sub->attributes['tab_title'] . "</h1>", $str);

	//$str = $this->generateMenu($str, $app_model);

	fwrite($fp, $str, strlen($str));

	?>
	 <li><a rel="external" data-ajax="flase"  class="item link" href="<?php echo $urlName; ?>">
                
                <h2>
                <?php 
                	if ($sub->attributes['tab_title'] != NULL)
                		echo $sub->attributes['tab_title'] ;
                ?>
                </h2>
                <p><?php echo substr($sub->attributes['description'], 0,75)?></p>
                
            </a></li>
	
	<?php 
}

?>

</ul>
</div>
