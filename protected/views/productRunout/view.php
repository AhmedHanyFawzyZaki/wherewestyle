<?php
$this->breadcrumbs=array(
	'Product Runouts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductRunout','url'=>array('index')),
	array('label'=>'Create ProductRunout','url'=>array('create')),
	array('label'=>'Update ProductRunout','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProductRunout','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View ProductRunout #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
	//	'id',
		'user_id',
		'product_id',
		'content',
	),
)); ?>
