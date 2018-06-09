<?php
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Contact','url'=>array('index')),
	array('label'=>'Create Contact','url'=>array('create')),
	array('label'=>'Update Contact','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Contact','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Contact #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'desc',
		//'image',
		'email',
		'address',
		'title',
	),
)); ?>
