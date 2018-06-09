<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
	array('label'=>'Create Product','url'=>array('create')),
	array('label'=>'Update Product','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Product','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Product #<?php echo $model->id; ?></h1>

<?php 
$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'title',
		array(
                      'name'=>'desc',
                      'type'=>'raw',
                ),
		array(
		'name'=>'main_image',
		'type'=>'raw',
		'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/products/thumbs_266X300/'.$model->main_image,$model->title,array('width'=>250)),
		),
		'meta',
		'price',
		'stock',
		'sold',
		'start_date',
		'cat_id'=>array(
			'name'=>'cat_id',
			'value'=>$model->categoryName->title,
		),
		'shop_id'=>array(
			'name'=>'shop_id',
			'value'=>$model->shopName->title,
		),
		//'slug',
		array(
			'name'=>'auto_delete',
			'type'=>'raw',
			'value'=>Helper::getStatus($model->auto_delete,'Yes','No'),
		),
		array(
			'name'=>'back_order',
			'type'=>'raw',
			'value'=>Helper::getStatus($model->back_order,'Yes','No'),
		),
		array(
			'name'=>'active',
			'type'=>'raw',
			'value'=>Helper::getStatus($model->active,'active','inactive'),
		),
		array(
			'name'=>'sale',
			'type'=>'raw',
			'value'=>Helper::getStatus($model->sale,'Yes','No'),
		),
		array(
			'name'=>'featured',
			'type'=>'raw',
			'value'=>Helper::getStatus($model->featured,'Yes','No'),
		),
		
	),
)); 



$gallery= Helper::getGalleryImages($model->gallery_id);

?>

<ul>
<?

		//if(! $gallery===null){
foreach($gallery as $image)
   {
	  ?>
	  
	  <li class="span2">
    <a href="#" class="thumbnail" rel="tooltip" data-title="<?= $image['name']?>">
        <img src="<?= Yii::app()->getBaseUrl(true)?>/gallery/<?= $image['id']?>small.jpg" alt="">
    </a>
</li>
	 
 <?   }  //} ?>
 </ul>
 
 