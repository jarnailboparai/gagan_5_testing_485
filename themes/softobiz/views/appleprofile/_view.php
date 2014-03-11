<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apple_email')); ?>:</b>
	<?php echo CHtml::encode($data->apple_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_gap_key_title')); ?>:</b>
	<?php echo CHtml::encode($data->phone_gap_key_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apple_p12_password')); ?>:</b>
	<?php echo CHtml::encode($data->apple_p12_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p12_file')); ?>:</b>
	<?php echo CHtml::encode($data->p12_file); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('store_provisioning_profile')); ?>:</b>
	<?php echo CHtml::encode($data->store_provisioning_profile); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('phonegap_id')); ?>:</b>
	<?php echo CHtml::encode($data->phonegap_id); ?>
	<br />

	*/ ?>

</div>
