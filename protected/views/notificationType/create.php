<?php
$this->breadcrumbs=array(
	'Notification Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NotificationType','url'=>array('index')),
);
?>

<h1>Create NotificationType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>