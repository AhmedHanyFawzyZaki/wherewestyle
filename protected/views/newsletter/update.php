<?php
$this->breadcrumbs = array(
    'Newsletters' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Subscribers', 'url' => array('index')),
    array('label' => 'Create Subscriber', 'url' => array('create')),
    array('label' => 'View Subscriber', 'url' => array('view', 'id' => $model->id)),
);
?>

<h1>Update Subscriber <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>