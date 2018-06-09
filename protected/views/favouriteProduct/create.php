<?php
$this->breadcrumbs=array(
	'Favourite Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FavouriteProduct','url'=>array('index')),
);
?>

<h1>Create FavouriteProduct</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>