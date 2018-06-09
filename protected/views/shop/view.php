<?php
$this->breadcrumbs=array(
	'Shops'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Shop','url'=>array('index')),
	array('label'=>'Create Shop','url'=>array('create')),
	array('label'=>'Update Shop','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Shop','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Shop #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'title',
		'seller_id',
		array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/shops/thumbs_266X300/'.$model->image,$model->title,array('width'=>250)),
		),
		array(
				  'name'=>'desc',
				  'type'=>'raw',
                ),
		
		'tags',
		
		array(
				  'name'=>'sale_desc',
				  'type'=>'raw',
                ),
		//'sale',
		//'small_featured',
		//'big_featured',
		//'active',
		array(
				  'name'=>'policy',
				  'type'=>'raw',
             ),
		//'slug',
	),
)); ?>
