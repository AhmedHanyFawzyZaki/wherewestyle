<?php
$this->breadcrumbs=array(
	'Datas'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Data','url'=>array('index')),
	array('label'=>'Create Data','url'=>array('create')),
	array('label'=>'Update Data','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Data','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Data','url'=>array('index')),
);
?>

<h1>View Data #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'content',
	),
)); ?>
