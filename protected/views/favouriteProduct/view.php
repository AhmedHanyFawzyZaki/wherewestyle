<?php
$this->breadcrumbs=array(
	'Favourite Products'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FavouriteProduct','url'=>array('index')),
	array('label'=>'Create FavouriteProduct','url'=>array('create')),
	array('label'=>'Update FavouriteProduct','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete FavouriteProduct','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View FavouriteProduct #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'pro_id'=>array(
			'name'=>'pro_id',
			'value'=>$model->pro->title,
		),
	),
)); ?>
