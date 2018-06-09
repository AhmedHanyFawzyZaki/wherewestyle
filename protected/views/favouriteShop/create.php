<?php
$this->breadcrumbs=array(
	'Favourite Shops'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FavouriteShop','url'=>array('index')),
);
?>

<h1>Create FavouriteShop</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>