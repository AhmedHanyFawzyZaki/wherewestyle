<?php
$this->breadcrumbs=array(
	'Follow Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FollowProduct','url'=>array('index')),
);
?>

<h1>Create FollowProduct</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>