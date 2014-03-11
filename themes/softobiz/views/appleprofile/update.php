<?php
$this->breadcrumbs=array(
	'Apple Profiles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AppleProfile', 'url'=>array('index')),
	array('label'=>'Create AppleProfile', 'url'=>array('create')),
	array('label'=>'View AppleProfile', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AppleProfile', 'url'=>array('admin')),
);
?>
<div class="form form-signin form_top_margin">
<h4 class="form-signin-heading">Update AppleProfile <?php echo $model->id; ?></h4>

<?php echo $this->renderPartial('_formapi', array('model'=>$model)); ?>
</div>
