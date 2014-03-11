<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_id')); ?>:</b>
	<?php echo CHtml::encode($data->application_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phonegap_id')); ?>:</b>
	<?php echo CHtml::encode($data->phonegap_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('android')); ?>:</b>
	<?php echo CHtml::encode($data->android); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ios')); ?>:</b>
	<?php echo CHtml::encode($data->ios); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />


</div>
