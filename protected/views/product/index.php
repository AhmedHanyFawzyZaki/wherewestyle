<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
	array('label'=>'Create Product','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Products</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		'title',
		
		'price',
		
		/*'stock',
		
		'sold',*/
		
		'cat_id'=>array(
			'name'=>'cat_id',
			'value'=>'$data->categoryName->title',
			'filter'=> CHtml::listData(Category::model()->findAll(),'id','title'),
		),
		
		'shop_id'=>array(
			'name'=>'shop_id',
			'value'=>'$data->shopName->title',
			'filter'=> CHtml::listData(Shop::model()->findAll(),'id','title'),
		),
		
		'active'=>array(
			'name'=>'active',
			'value'=>'Helper::getStatus($data->active,"active","inactive")',
			'filter'=> array('1'=>'active','0'=>'inactive'),
		),
		
		'featured'=>array(
			'name'=>'featured',
			'value'=>'Helper::getStatus($data->featured,"Featured","Not Featured")',
			'filter'=> array('1'=>'Featured','0'=>'Not Featured'),
		),
		
		'sale'=>array(
			'name'=>'sale',
			'value'=>'Helper::getStatus($data->sale,"Yes","No")',
			'filter'=> array('1'=>'Yes','0'=>'No'),
		),
		
		array(
			'header'=>'main_image',
			'type'=>'html',
			'value'=>'(!empty($data->main_image))?CHtml::image(Yii::app()->request->baseUrl."/media/products/thumbs_266X300/".$data->main_image,"",array("style"=>"width:83px;height:65px;")):"no image"',
		) ,

//		array(
//				'class'=>'CLinkColumn',
//				'label'=>'Runout',
//				'urlExpression'=>'Yii::app()->request->baseUrl."/ProductRunout/index?id=".$data->id',
//				'header'=>'product Runout'
//	    ),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
