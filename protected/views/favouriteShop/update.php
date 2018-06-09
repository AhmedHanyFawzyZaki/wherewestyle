<?php
$this->breadcrumbs=array(
	'Favourite Shops'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FavouriteShop','url'=>array('index')),
	array('label'=>'Create FavouriteShop','url'=>array('create')),
	array('label'=>'View FavouriteShop','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update FavouriteShop <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>