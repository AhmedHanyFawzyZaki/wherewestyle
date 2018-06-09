<?php
$this->breadcrumbs=array(
	'Follow Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FollowUser','url'=>array('index')),
	array('label'=>'Create FollowUser','url'=>array('create')),
	array('label'=>'View FollowUser','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update FollowUser <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>