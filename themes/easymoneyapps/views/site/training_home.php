<?php if (isset($pages)){?>
	<div class="row">
		<div class="span11">
			<div class="btn-group centered">
			<?php foreach ($pages as $page){ ?>
					<a href="<?php echo $this->createUrl('site/training&id='.$page->id); ?>" class="btn btn-large"><?php echo $page->title; ?></a>
			<?php } ?>

			</div>
		</div>
	</div>
<?php } ?>

<?php if ($model){ ?>
	<div id="content">
		<h2> <?php echo $model->title; ?> </h2>
		<p> <?php echo $model->text; ?> </p>
	</div>
	<?php
	if ($isadmin){
		$edit_url = $this->createUrl('editor/training', array('id'=>$model->id));
		echo CHtml::link('Edit this page', $edit_url);
		echo "<br />";
		if (!$model->parent){
			$add_url = $this->createUrl('editor/training');
			echo CHtml::link('Add a new page', $add_url);
		} else {
			$delete_url = $this->createUrl('editor/delete', array('id'=>$model->id));
			echo CHtml::link('Delete this page', $delete_url,  array('onclick'=>"if (!confirm('Are you sure?')){return false}"));
		}
	}
	?>
<?php } ?>
