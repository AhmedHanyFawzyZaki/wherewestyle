<?php
$this->breadcrumbs=array(
	'All Countries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AllCountries','url'=>array('index')),
);
?>

<h1>Create AllCountries</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>