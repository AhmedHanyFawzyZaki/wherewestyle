<?php
$this->breadcrumbs=array(
	'Notification Types'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NotificationType','url'=>array('index')),
	array('label'=>'Create NotificationType','url'=>array('create')),
	array('label'=>'Update NotificationType','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete NotificationType','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View NotificationType #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
	//	'id',
		'type',
	//	'temp1',
	),
)); ?>
