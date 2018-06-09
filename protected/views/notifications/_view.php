<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notif_type')); ?>:</b>
	<?php echo CHtml::encode($data->notif_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notif_time')); ?>:</b>
	<?php echo CHtml::encode($data->notif_time); ?>
	<br />


</div>