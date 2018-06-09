<?php
$this->breadcrumbs=array(
	'Coupons'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Coupon','url'=>array('index')),
	array('label'=>'Create Coupon','url'=>array('create')),
	array('label'=>'Update Coupon','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Coupon','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Coupon #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'title',
		'shop_id'=>array(
			'name'=>'shop_id',
			'value'=>$model->shopName->title,
		),
		array(
			'name'=>'type',
			'type'=>'raw',
			'value'=>Helper::getStatus($model->type,'Flat Fee','Percentage'),
		),
		'code',
		'redem_num',
		'used_num',
		'discount',
		
	),
)); ?>
