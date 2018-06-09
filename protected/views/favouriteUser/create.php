<?php
$this->breadcrumbs=array(
	'Favourite Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FavouriteUser','url'=>array('index')),
);
?>

<h1>Create FavouriteUser</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>