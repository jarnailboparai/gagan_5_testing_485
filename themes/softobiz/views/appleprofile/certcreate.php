<?php
$this->breadcrumbs=array(
	'Apple Profiles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AppleProfile', 'url'=>array('index')),
	array('label'=>'Manage AppleProfile', 'url'=>array('admin')),
);
?>
<div class="form form-signin form_top_margin">
<h4 class="form-signin-heading">Create AppleProfile</h4>

<?php echo $this->renderPartial('_certformapi', array('model'=>$model,'dropdown'=>$dropdown)); ?>
</div>
