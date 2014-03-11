<?php
$this->breadcrumbs=array(
	'Applinks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Applink', 'url'=>array('index')),
	array('label'=>'Create Applink', 'url'=>array('create')),
	array('label'=>'View Applink', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Applink', 'url'=>array('admin')),
);
?>

<h1>Update Applink <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
