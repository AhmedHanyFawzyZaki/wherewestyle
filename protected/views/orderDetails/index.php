<?php
$this->breadcrumbs=array(
	'Order Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OrderDetails','url'=>array('index')),
	array('label'=>'Create OrderDetails','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('order-details-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Order Details</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'order-details-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
	//	'order_id',
	//	'user_id',
		'product_id'=>array(
			'name'=>'product_id',
			'value'=>'$data->product->title',
		),
		
		'qty',
		array(
                    'name' => 'cost',
                    'value' => '$data->order->currency_rate == 1 ? $data->cost : $data->cost / $data->order->currency_rate',
                ),
		array(
			'header'=>'image',
			'type'=>'html',
			'value'=>'(!empty($data->product->main_image))?CHtml::image(Yii::app()->request->baseUrl."/media/products/thumbs_266X300/".$data->product->main_image,"",array("style"=>"width:100px;height:75px;")):"no image"',
		) ,
		//'create_time',
		/*
		
		'temp1',
		'temp2',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
