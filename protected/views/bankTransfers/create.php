<?php
$this->breadcrumbs=array(
	'Bank Transfers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BankTransfers','url'=>array('index')),
);
?>

<h1>Create BankTransfers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>