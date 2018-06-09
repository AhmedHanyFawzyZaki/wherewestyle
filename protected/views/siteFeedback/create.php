<?php
$this->breadcrumbs=array(
	'Site Feedbacks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SiteFeedback','url'=>array('index')),
);
?>

<h1>Create SiteFeedback</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>