<?php
$this->breadcrumbs=array(
	'All Countries'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AllCountries','url'=>array('index')),
	array('label'=>'Create AllCountries','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('all-countries-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage All Countries</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'all-countries-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'country_name',
		'country_code',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
