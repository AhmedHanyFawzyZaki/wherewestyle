<?php
$this->breadcrumbs=array(
	'Follow Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FollowUser','url'=>array('index')),
);
?>

<h1>Create FollowUser</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>