<?php
$this->breadcrumbs=array(
	'Apple Profiles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AppleProfile', 'url'=>array('index')),
	array('label'=>'Create AppleProfile', 'url'=>array('create')),
	array('label'=>'Update AppleProfile', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AppleProfile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AppleProfile', 'url'=>array('admin')),
);
?>

<h4 class="view_app_title pull-left">View AppleProfile #<?php echo $model->id; ?></h4>

<a href="<?php echo CHtml::normalizeUrl(array('appleprofile/update','id'=>$model->id)); ?>" class="btn btn-info pull-right edit_information">Edit Info</a>
<a href="<?php echo CHtml::normalizeUrl(array('appleprofile/applelist')); ?>" class="btn btn-info pull-right edit_information">Cancel</a>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		
		'apple_email',
		'phone_gap_key_title',
		'apple_p12_password',
		'p12_file',
		'store_provisioning_profile',

	),
	'htmlOptions' => array( 'class'=>'table table-bordered')
)); ?>
