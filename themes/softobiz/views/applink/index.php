<?php
$this->breadcrumbs=array(
	'Applinks',
);

$this->menu=array(
	array('label'=>'Create Applink', 'url'=>array('create')),
	array('label'=>'Manage Applink', 'url'=>array('admin')),
);
?>

<h1>Applinks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
