<?php
$this->breadcrumbs=array(
	'Favourite Shops'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FavouriteShop','url'=>array('index')),
	array('label'=>'Create FavouriteShop','url'=>array('create')),
	array('label'=>'Update FavouriteShop','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete FavouriteShop','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View FavouriteShop #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'shop_id'=>array(
			'name'=>'shop_id',
			'value'=>$model->shop->title,
		),
	),
)); ?>
