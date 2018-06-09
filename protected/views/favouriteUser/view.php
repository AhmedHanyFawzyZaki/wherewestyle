<?php
$this->breadcrumbs=array(
	'Favourite Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FavouriteUser','url'=>array('index')),
	array('label'=>'Create FavouriteUser','url'=>array('create')),
	array('label'=>'Update FavouriteUser','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete FavouriteUser','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View FavouriteUser #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'member_id'=>array(
			'name'=>'member_id',
			'value'=>$model->member->username,
		),
	),
)); ?>
