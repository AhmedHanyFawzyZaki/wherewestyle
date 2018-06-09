<?php
$this->breadcrumbs=array(
	'Follow Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FollowProduct','url'=>array('index')),
	array('label'=>'Create FollowProduct','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('follow-product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Follow Products</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'follow-product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'pro_id'=>array(
			'name'=>'pro_id',
			'value'=>'$data->pro->title',
			'filter'=> CHtml::listData(Product::model()->findAll(),'id','title'),
		),
		'userList'=>array(
		'name'=>'userList',
		'filter'=>''
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
