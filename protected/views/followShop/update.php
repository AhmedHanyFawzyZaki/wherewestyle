<?php
$this->breadcrumbs=array(
	'Follow Shops'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FollowShop','url'=>array('index')),
	array('label'=>'Create FollowShop','url'=>array('create')),
	array('label'=>'View FollowShop','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update FollowShop <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>