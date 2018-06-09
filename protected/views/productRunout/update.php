<?php
$this->breadcrumbs=array(
	'Product Runouts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductRunout','url'=>array('index')),
	array('label'=>'Create ProductRunout','url'=>array('create')),
	array('label'=>'View ProductRunout','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update ProductRunout <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>