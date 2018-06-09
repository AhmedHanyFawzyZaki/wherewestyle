<?php
$this->breadcrumbs=array(
	'Ads'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Ads','url'=>array('index')),
	array('label'=>'Create Ads','url'=>array('create')),
	array('label'=>'Update Ads','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Ads','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Ads #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'image',
		'link',
		'price',
		'publish',
	),
)); ?>
