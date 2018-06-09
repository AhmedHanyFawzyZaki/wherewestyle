<?php
$this->breadcrumbs=array(
	'Ads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ads','url'=>array('index')),
);
?>

<h1>Create Ads</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>