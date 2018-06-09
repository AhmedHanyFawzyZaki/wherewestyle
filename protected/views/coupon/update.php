<?php
$this->breadcrumbs=array(
	'Coupons'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Coupon','url'=>array('index')),
	array('label'=>'Create Coupon','url'=>array('create')),
	array('label'=>'View Coupon','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update Coupon <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>