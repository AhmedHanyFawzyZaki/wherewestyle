<?php
$this->breadcrumbs=array(
	'Order Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OrderDetails','url'=>array('index')),
	array('label'=>'Create OrderDetails','url'=>array('create')),
	array('label'=>'Update OrderDetails','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete OrderDetails','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View OrderDetails #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'order_id',
		'user_id',
		'product_id',
		'create_time',
		'qty',
		array(
                    'name' => 'cost',
                    'value' => $model->order->currency_rate == 1 ? $model->cost : $model->cost / $model->order->currency_rate,
                ),
	),
)); ?>
