<?php
$this->breadcrumbs=array(
	'Product Runouts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductRunout','url'=>array('index')),
	array('label'=>'Create ProductRunout','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-runout-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Product Runouts</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'product-runout-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'user_id'=>array(
			'name'=>'user_id',			
			'value'=>'$data->user->username',
			'filter'=>User::model()->getUsers(),
		),
	//	'product_id',
		'content',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
