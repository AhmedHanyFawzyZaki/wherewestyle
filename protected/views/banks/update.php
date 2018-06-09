<?php
$this->breadcrumbs = array(
    'Banks' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Bank Accounts', 'url' => array('index')),
    array('label' => 'Create Bank Account', 'url' => array('create')),
    array('label' => 'View Bank Account', 'url' => array('view', 'id' => $model->id)),
);
?>

<h1>Update Bank Account : <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>