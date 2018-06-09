<?php
$this->breadcrumbs=array(
	'Favourite Products'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FavouriteProduct','url'=>array('index')),
	array('label'=>'Create FavouriteProduct','url'=>array('create')),
	array('label'=>'View FavouriteProduct','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update FavouriteProduct <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>