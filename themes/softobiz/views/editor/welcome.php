<?php if (isset($pages) && !empty($pages)){?>
<div class="row">
	<div class="span11">
		<div class="btn-group centered">
		<?php foreach ($pages as $page){ ?>
				<a href="<?php echo $this->createUrl('site/welcome&id='.$page->id); ?>" class="btn btn-large"><?php echo $page->title; ?></a>
		<?php } ?>

		</div>
	</div>
</div>
<?php } ?>
<div id="content" class="form">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'page-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); 
	?>
	<div class="row">
		<?php echo CHtml::activeLabel($model, 'Title'); ?>
		<?php echo CHtml::activeTextField($model, 'title'); ?>
		<?php echo CHtml::error($model, 'title'); ?>
	</div>
	<div class="row">
	<?php
	$this->widget('application.components.widgets.XHeditor',array(
		'model'=>$model,
		'modelAttribute'=>'text',
		'showModelAttributeValue'=>true, // displays the value of $modelInstance->attribute in the textarea
		'config'=>array(
			//'id'=>'xh1',
			'name'=>'Pages[text]',
			'tools'=>'fill', // mini, simple, fill or from XHeditor::$_tools
			'width'=>'100%',
			//see XHeditor::$_configurableAttributes for more
		),
	));
	?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>
