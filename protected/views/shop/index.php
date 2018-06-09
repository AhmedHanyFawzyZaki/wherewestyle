<?php
$this->breadcrumbs=array(
	'Shops'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Shop','url'=>array('index')),
	array('label'=>'Create Shop','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('shop-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Shops</h1>

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
	'id'=>'shop-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'title',
		//'desc',
		array(
			'header'=>'image',
			'type'=>'html',
			'value'=>'(!empty($data->image))?CHtml::image(Yii::app()->request->baseUrl."/media/shops/thumbs_266X300/".$data->image,"",array("style"=>"width:100px;height:75px;")):"no image"',
		) ,
		'seller_id'=>array(// display 'author.username' using an expression
                        'name'=>'seller_id',
                       'value'=>'$data->seller->username',
                        'filter'=> User::model()->getSellers(),
                    ),
		array(
			'name'=>'active',
			'filter' => array('0' => 'not activated','1' => 'activated',),
			'value' => '$data->active ? "activated" : "not activated"'
		),
		/*
		'sale',
		'sale_desc',
		'small_featured',
		'big_featured',
		'active',
		'policy',
		'slug',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
