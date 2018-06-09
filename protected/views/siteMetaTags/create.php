<?php
$this->breadcrumbs=array(
	'Site Meta Tags'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SiteMetaTags','url'=>array('index')),
);
?>

<h1>Create SiteMetaTags</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>