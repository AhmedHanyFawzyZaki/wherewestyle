<?php
$this->breadcrumbs=array(
	'Ads'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ads','url'=>array('index')),
	array('label'=>'Create Ads','url'=>array('create')),
	array('label'=>'View Ads','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update Ads <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>