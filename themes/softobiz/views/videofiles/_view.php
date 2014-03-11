<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actual_url')); ?>:</b>
	<?php echo CHtml::encode($data->actual_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mp4_url')); ?>:</b>
	<?php echo CHtml::encode($data->mp4_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('threegp_url')); ?>:</b>
	<?php echo CHtml::encode($data->threegp_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('m4v')); ?>:</b>
	<?php echo CHtml::encode($data->m4v); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thumbnail_url')); ?>:</b>
	<?php echo CHtml::encode($data->thumbnail_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated')); ?>:</b>
	<?php echo CHtml::encode($data->updated); ?>
	<br />

	*/ ?>

</div>
