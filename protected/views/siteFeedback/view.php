<?php
$this->breadcrumbs=array(
	'Site Feedbacks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SiteFeedback','url'=>array('index')),
	array('label'=>'Create SiteFeedback','url'=>array('create')),
	array('label'=>'Update SiteFeedback','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete SiteFeedback','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View SiteFeedback #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'full_name',
		'email',
		'content',
		'feed_time',
	),
)); ?>
