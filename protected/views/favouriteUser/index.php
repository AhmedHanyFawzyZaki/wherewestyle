<?php
$this->breadcrumbs=array(
	'Favourite Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FavouriteUser','url'=>array('index')),
	array('label'=>'Create FavouriteUser','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('favourite-user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Favourite Users</h1>

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
	'id'=>'favourite-user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>'$data->user->username',
			'filter'=> CHtml::listData(User::model()->findAll('groups_id<>6'),'id','username'),
		),
		'member_id'=>array(
			'name'=>'member_id',
			'value'=>'$data->member->username',
			'filter'=> CHtml::listData(User::model()->findAll('groups_id<>6'),'id','username'),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
