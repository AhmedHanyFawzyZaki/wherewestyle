<?php
$this->breadcrumbs=array(
	'All Countries'=>array('index'),
	$model->country_id=>array('view','id'=>$model->country_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AllCountries','url'=>array('index')),
	array('label'=>'Create AllCountries','url'=>array('create')),
	array('label'=>'View AllCountries','url'=>array('view','id'=>$model->country_id)),
	array('label'=>'Manage AllCountries','url'=>array('index')),
);
?>

<h1>Update AllCountries <?php echo $model->country_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>