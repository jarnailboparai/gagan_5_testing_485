<?php
$this->breadcrumbs=array(
	'Apple Profiles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AppleProfile', 'url'=>array('index')),
	array('label'=>'Create AppleProfile', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('apple-profile-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Apple Profiles</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'apple-profile-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'apple_email',
		'phone_gap_key_title',
		'apple_p12_password',
		'p12_file',
		/*
		'store_provisioning_profile',
		'phonegap_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
