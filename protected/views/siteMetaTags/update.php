<?php
$this->breadcrumbs=array(
	'Site Meta Tags'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SiteMetaTags','url'=>array('index')),
	array('label'=>'Create SiteMetaTags','url'=>array('create')),
	array('label'=>'View SiteMetaTags','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update SiteMetaTags <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>