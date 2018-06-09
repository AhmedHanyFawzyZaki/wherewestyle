<?php
$this->breadcrumbs=array(
	'Follow Products'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FollowProduct','url'=>array('index')),
	array('label'=>'Create FollowProduct','url'=>array('create')),
	array('label'=>'Update FollowProduct','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete FollowProduct','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View FollowProduct #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'pro_id'=>array(
			'name'=>'pro_id',
			'value'=>$model->pro->title,
		),
		'userList',
	),
)); ?>
