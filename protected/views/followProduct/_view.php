<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_id')); ?>:</b>
	<?php echo CHtml::encode($data->pro_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('followers')); ?>:</b>
	<?php echo CHtml::encode($data->followers); ?>
	<br />


</div>