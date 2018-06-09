<?php
$this->breadcrumbs=array(
	'Notification Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List NotificationType','url'=>array('index')),
	array('label'=>'Create NotificationType','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('notification-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Notification Types</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'notification-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'type',
	//	'temp1',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
