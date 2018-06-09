<?php
$this->breadcrumbs=array(
	'Follow Shops'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FollowShop','url'=>array('index')),
	array('label'=>'Create FollowShop','url'=>array('create')),
	array('label'=>'Update FollowShop','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete FollowShop','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View FollowShop #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'shop_id'=>array(
			'name'=>'shop_id',
			'value'=>$model->shop->title,
		),
		'userList',
	),
)); ?>
