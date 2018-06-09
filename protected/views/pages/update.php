<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pages','url'=>array('index')),
	
	array('label'=>'View Page','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update Page <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>