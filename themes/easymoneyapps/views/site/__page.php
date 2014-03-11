<!--<div class="row">
	<div class="span11">
		<div class="btn-group centered">
			<a class="btn btn-large" href="<?php echo $this->createUrl('site/training'); ?>">Training Home</a>
			<a class="btn btn-large" href="<?php echo $this->createUrl('site/videotraining'); ?>">Video Training</a>
			<a class="btn btn-large" href="<?php echo $this->createUrl('site/pdfguide'); ?>">PDF Training Guides</a>
			<a class="btn btn-large active" href="<?php echo $this->createUrl('site/contracts'); ?>">Sample Contracts</a>
		</div>
	</div>
</div>-->

<? if ($pages){
	$menuitems = array();
	?>
<div class="row">
	<div class="span11">
		<div class="btn-group centered">
<?php foreach ($pages as $page){ ?>
		<a href="<?php echo $this->createUrl('site/page&id='.$page->id); ?>" class="btn btn-large"><?php echo $page->title; ?></a>
<?php }
	/*$menuitems[] = array(
			'label' => $page->title,
			'url' => array('/site/page&id='.$page->id)
		);
	echo "<pre>";
	print_r($menuitems);
	echo "</pre>";*/
?>
		</div>
	</div>
</div>
<!--<div class="row">
	<div class="span11">	
		<div class="btn-group">
			<?php
				/*$this->widget('zii.widgets.CMenu',array(
					'items' => $menuitems, 
					'htmlOptions' => array('class' => 'btn btn-large')));*/
			}
			?>
		</div>
	</div>
</div>-->
<div id="content">
	<p>
		<?php echo $model->text; ?>
	</p>
</div>
