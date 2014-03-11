<?php
$this->breadcrumbs=array(
	'Apple Profiles',
);

$this->menu=array(
	array('label'=>'Create AppleProfile', 'url'=>array('create')),
	array('label'=>'Manage AppleProfile', 'url'=>array('admin')),
);
?>

<h1>Apple Profiles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
