<?php
$this->breadcrumbs=array(
	'Bank Transfers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BankTransfers','url'=>array('index')),
	array('label'=>'Create BankTransfers','url'=>array('create')),
	array('label'=>'View BankTransfers','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update BankTransfers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>