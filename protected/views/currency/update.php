<?php
$this->breadcrumbs = array(
    'Currencies' => array('index'),
    $model->title => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Currencies', 'url' => array('index')),
    array('label' => 'Create Currency', 'url' => array('create')),
    array('label' => 'View Currency', 'url' => array('view', 'id' => $model->id)),
);
?>

<h1>Update Currency : <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>