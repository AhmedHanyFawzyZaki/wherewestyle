<?php
$this->breadcrumbs=array(
	'Notifications'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Notifications','url'=>array('index')),
	array('label'=>'Create Notifications','url'=>array('create')),
	array('label'=>'Update Notifications','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Notifications','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Notifications #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
	//	'id',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,	
		),
		'notif_type'=>array(
			'name'=>'notif_type',
			'value'=>$model->notification->type,
		),
		'notif_time',
	),
)); ?>
