<?php
$this->breadcrumbs=array(
	'Notification Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NotificationType','url'=>array('index')),
	array('label'=>'Create NotificationType','url'=>array('create')),
	array('label'=>'View NotificationType','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update NotificationType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>