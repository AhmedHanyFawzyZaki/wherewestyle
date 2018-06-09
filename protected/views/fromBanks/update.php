<?php
$this->breadcrumbs = array(
    'From Banks' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Allowed Paying Banks', 'url' => array('index')),
    array('label' => 'Create Paying Bank', 'url' => array('create')),
    array('label' => 'View Paying Bank', 'url' => array('view', 'id' => $model->id)),
);
?>

<h1>Update Paying Bank <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>