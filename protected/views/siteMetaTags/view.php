<?php
$this->breadcrumbs=array(
	'Site Meta Tags'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SiteMetaTags','url'=>array('index')),
	array('label'=>'Create SiteMetaTags','url'=>array('create')),
	array('label'=>'Update SiteMetaTags','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete SiteMetaTags','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View SiteMetaTags #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'tags',
		'desc',
		'author',
	),
)); ?>
