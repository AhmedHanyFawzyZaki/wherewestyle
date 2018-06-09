<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Category','url'=>array('index')),
	array('label'=>'Create Category','url'=>array('create')),
);

?>

<h1>Manage Categories</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		'title',
		/*array(
			
			'value'=>'CHtml::link("Show sub categories", Yii::app()->createUrl("category/showsub",array("parent"=>$data->id ))) ',
			'type'	=>'raw',
				),
				
    	
		
		/*
		'image',
		'id',
		'sort',
		'desc',
		'parent_id',
		'temp1',
		'temp2',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
