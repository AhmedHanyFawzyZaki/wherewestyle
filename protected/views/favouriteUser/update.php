<?php
$this->breadcrumbs=array(
	'Favourite Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FavouriteUser','url'=>array('index')),
	array('label'=>'Create FavouriteUser','url'=>array('create')),
	array('label'=>'View FavouriteUser','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update FavouriteUser <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>