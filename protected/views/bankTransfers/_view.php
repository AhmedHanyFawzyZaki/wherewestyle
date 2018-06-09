<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('internet_banking_nickname')); ?>:</b>
	<?php echo CHtml::encode($data->internet_banking_nickname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_date')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_hour')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_hour); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_minute')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_minute); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_reference_no')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_reference_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount_transfered')); ?>:</b>
	<?php echo CHtml::encode($data->amount_transfered); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('receipt')); ?>:</b>
	<?php echo CHtml::encode($data->receipt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_info')); ?>:</b>
	<?php echo CHtml::encode($data->other_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_id')); ?>:</b>
	<?php echo CHtml::encode($data->order_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	*/ ?>

</div>