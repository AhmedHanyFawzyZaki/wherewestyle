<?php
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Contact','url'=>array('index')),
);
?>

<h1>Create Contact</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>