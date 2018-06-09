<?php
$this->breadcrumbs=array(
	'Site Feedbacks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SiteFeedback','url'=>array('index')),
	array('label'=>'Create SiteFeedback','url'=>array('create')),
	array('label'=>'View SiteFeedback','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update SiteFeedback <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>