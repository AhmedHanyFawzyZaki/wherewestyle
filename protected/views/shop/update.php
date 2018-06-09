<?php
$this->breadcrumbs=array(
	'Shops'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Shop','url'=>array('index')),
	array('label'=>'Create Shop','url'=>array('create')),
	array('label'=>'View Shop','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update Shop <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>