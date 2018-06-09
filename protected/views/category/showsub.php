<?php
$this->breadcrumbs=array(
'Courses'=>array('index'),
'Manage -',$model->title
);

$this->menu=array(
array('label'=>'List Categories','url'=>array('index')),
array('label'=>'Add subcategory ','url'=>array('create','parent_id'=>$model->id)),
);

?>

<h1><?php  echo $model->title ?> - Sub Categories</h1>

<?php
 $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'category-grid',
'dataProvider'=>$sublist,

'columns'=>array(

	'title',
	/*

	   'cost',

	   'parent',
	*/
	array(
		'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
	
	),
),
)); ?>


