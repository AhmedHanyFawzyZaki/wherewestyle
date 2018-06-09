<?php
$this->breadcrumbs=array(
	'Follow Products'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FollowProduct','url'=>array('index')),
	array('label'=>'Create FollowProduct','url'=>array('create')),
	array('label'=>'View FollowProduct','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update FollowProduct <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>