<?php
$this->breadcrumbs=array(
	'Bank Transfers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BankTransfers','url'=>array('index')),
	array('label'=>'Create BankTransfers','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bank-transfers-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Bank Transfers</h1>

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
	'id'=>'bank-transfers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'internet_banking_nickname',
		'transaction_date',
		'transaction_hour',
		'transaction_minute',
		'transaction_reference_no',
		/*
		'amount_transfered',
		'receipt',
		'other_info',
		'order_id',
		'date',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
