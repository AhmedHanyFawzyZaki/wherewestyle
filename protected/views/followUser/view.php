<?php
$this->breadcrumbs=array(
	'Follow Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FollowUser','url'=>array('index')),
	array('label'=>'Create FollowUser','url'=>array('create')),
	array('label'=>'Update FollowUser','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete FollowUser','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View FollowUser #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'userList',
	),
)); ?>
