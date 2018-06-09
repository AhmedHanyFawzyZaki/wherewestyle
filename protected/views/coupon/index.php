<?php
$this->breadcrumbs=array(
	'Coupons'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Coupon','url'=>array('index')),
	array('label'=>'Create Coupon','url'=>array('create')),
);
?>

<h1>Manage Coupons</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'coupon-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'title',
		'code',
		'redem_num',
		'used_num',
		'discount',
		'type'=>array(
			'name'=>'type',
			'value'=>'Helper::getStatus($data->type,"Flat Fee","Percentage")',
			'filter'=> array('1'=>'Flat Fee','0'=>'Percentage'),
		),
		'shop_id'=>array(
			'name'=>'shop_id',
			'value'=>'$data->shopName->title',
			'filter'=> CHtml::listData(Shop::model()->findAll(),'id','title'),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
