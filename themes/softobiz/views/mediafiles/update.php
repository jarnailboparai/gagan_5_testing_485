<?php
$this->breadcrumbs=array(
	'Media Files'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MediaFiles', 'url'=>array('index')),
	array('label'=>'Create MediaFiles', 'url'=>array('create')),
	array('label'=>'View MediaFiles', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MediaFiles', 'url'=>array('admin')),
);
?>

<h1>Update MediaFiles <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
