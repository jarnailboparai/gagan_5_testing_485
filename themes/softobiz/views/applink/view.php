<?php
$this->breadcrumbs=array(
	'Applinks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Applink', 'url'=>array('index')),
	array('label'=>'Create Applink', 'url'=>array('create')),
	array('label'=>'Update Applink', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Applink', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Applink', 'url'=>array('admin')),
);
?>

<h1>View Applink #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'application_id',
		'phonegap_id',
		'android',
		'ios',
		'created',
	),
)); ?>
