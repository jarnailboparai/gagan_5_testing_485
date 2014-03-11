<?php
$this->breadcrumbs=array(
	'Applinks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Applink', 'url'=>array('index')),
	array('label'=>'Manage Applink', 'url'=>array('admin')),
);
?>

<h1>Create Applink</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
