<?php
$this->breadcrumbs=array(
	'Follow Shops'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FollowShop','url'=>array('index')),
);
?>

<h1>Create FollowShop</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>