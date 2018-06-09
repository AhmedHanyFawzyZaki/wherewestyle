<?php
$this->breadcrumbs=array(
	'Coupons'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Coupon','url'=>array('index')),
);
?>

<h1>Create Coupon</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>