<?php
$this->breadcrumbs=array(
	'Product Runouts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductRunout','url'=>array('index')),
);
?>

<h1>Create ProductRunout</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>