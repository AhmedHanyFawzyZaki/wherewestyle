<?php
$this->breadcrumbs=array(
	'All Countries'=>array('index'),
	$model->country_id,
);

$this->menu=array(
	array('label'=>'List AllCountries','url'=>array('index')),
	array('label'=>'Create AllCountries','url'=>array('create')),
	array('label'=>'Update AllCountries','url'=>array('update','id'=>$model->country_id)),
	array('label'=>'Delete AllCountries','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->country_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AllCountries','url'=>array('index')),
);
?>

<h1>View AllCountries #<?php echo $model->country_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'country_id',
		'country_code',
		'country_name',
		'cost_country',
	),
)); ?>
