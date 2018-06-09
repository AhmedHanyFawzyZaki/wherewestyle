<?php
$this->breadcrumbs=array(
	'Follow Shops'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FollowShop','url'=>array('index')),
	array('label'=>'Create FollowShop','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('follow-shop-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Follow Shops</h1>

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
	'id'=>'follow-shop-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'shop_id'=>array(
			'name'=>'shop_id',
			'value'=>'$data->shop->title',
			'filter'=> CHtml::listData(Shop::model()->findAll(),'id','title'),
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
