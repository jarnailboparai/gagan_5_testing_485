<?php
$this->breadcrumbs=array(
	'Video Files'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List VideoFiles', 'url'=>array('index')),
	array('label'=>'Create VideoFiles', 'url'=>array('create')),
	array('label'=>'Update VideoFiles', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete VideoFiles', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VideoFiles', 'url'=>array('admin')),
);
?>

<h1>View VideoFiles #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'actual_url',
		'mp4_url',
		'threegp_url',
		'm4v',
		'thumbnail_url',
		'title',
		'description',
		'created',
		'updated',
	),
)); ?>
